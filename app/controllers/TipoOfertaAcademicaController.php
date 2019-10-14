<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H; 
use App\Models\Users;
use App\Models\tipoOfertaAcademica;

class TipoOfertaAcademicaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
      $this->currentUser=Users::currentUser();
   }
	
   public function indexAction(){
	  // Lleva y muestra el listado de ofertas academicas
      $datos = tipoOfertaAcademica::listarOfertas();
      
	  foreach($datos as $dato){
		  
		  $eliminable = tipoOfertaAcademica::validaEliminable($dato->id);
		  //echo "<br><br><br><br>".$eliminable;
		  $estEliminable = 'false';
		  
		  if($eliminable!=0){
			  $estEliminable = 'true';
		  }
		  //Creo un nuevo atributo y le asigno si es eliminable
		  $dato->Eliminable = $estEliminable;
		  //array_push($dato,'Eliminable'=>$estEliminable);
	  
	  }
	   
	  $this->view->datos =$datos;
      $this->view->render('tipoOfertaAcademica/index');
   }	
	
   public function nuevoAction(){
		// Se ejecuta al cargar form nuevo tambien
	   	if(isset($_GET["idTOA"]) && isset($_GET["nomTOA"])){
			$this->view->idTOA = $_GET["idTOA"];
			$this->view->nomTOA = $_GET["nomTOA"];
		}else{
			$this->view->idTOA = "";
			$this->view->nomTOA = "";
		}
	   
		$tipoOfertaAcademica = new tipoOfertaAcademica();
		$this->view->tipoOfertaAcademica = $tipoOfertaAcademica;
		$this->view->displayErrors = $tipoOfertaAcademica->getErrorMessages();
		$this->view->postAction = PROOT . 'tipoOfertaAcademica' . DS . 'nuevo';
		$this->view->renderModal('tipoOfertaAcademica/crear');
   }	
	
	// Guarda nuevo tipo de oferta academico validando que no exista el nombre de la oferta
	public function guardarAction($nomTOA=""){
		
		//var_dump($_POST);
		if($nomTOA==""){
			$nomTOA = $_POST["txt_nomTOA"];
		}
		
		$datos = new tipoOfertaAcademica();
		
		//Valida que el nombre no exista
		$rtaExisteTOA = tipoOfertaAcademica::buscarOfertaAcademica($nomTOA);
		if(count($rtaExisteTOA)<=0){
			// Pasa los datos del frm al modelo
			$datos->assign(['nom'=>$nomTOA],tipoOfertaAcademica::blackList);
			if($datos->save()){
				$resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
			}else{
				$resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
			}
			
		}else{
			$resp = ['success'=>false,'errors'=>'El nombre ya está en uso'];
		}
		
		return $this->jsonResponse($resp);
		unset($datos);
		
	}

	public function eliminarTOAAction($idTOA=""){

		//var_dump($_POST);
		if($idTOA==""){
			$idTOA = $_POST["idTOA"];
		}


		$datos = tipoOfertaAcademica::findById((int)$idTOA);
		if($datos){
			$datos->delete();
			$resp = ['success'=>true];
			return $this->jsonResponse($resp);
		}
		
		unset($datos);	

	}
		

	public function editarAction(){
		$id = $this->request->get('idTOA');
		$nom = $this->request->get('nomTOA');
		
	  	$datos = tipoOfertaAcademica::findById((int)$id);

	   	if(!$datos) Router::redirect('tipoOfertaAcademica');
		
		//$getVars = $this->request->get();
		//var_dump($getVars);
		//$datos->assign($this->request->get());
		$datos->assign(['id'=>$id, 'nom'=>$nom]);
		if($datos->save())
		$resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
		else
		$resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

		return $this->jsonResponse($resp);

	}


   public function validarDuplicadoAction($nombre_campo,$valor){
      $datos = tipoOfertaAcademica::findFirst([
         'conditions'=>$nombre_campo.' = ? ',
         'bind'=>[$valor]
      ]);
      if($datos)
         $resp = ['success'=>true,'mensaje'=>'Registre otro valor diferente o contacte con el administrador del sistema.'];
      else
         $resp = ['success'=>false];

      $this->jsonResponse($resp);
   }	

}