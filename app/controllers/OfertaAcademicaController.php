<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Users;
use App\Models\Empresas;
use App\Models\ofertaAcademica;

use App\Models\Ofertasoa;
use App\Models\OfertasEstados;

use App\Models\tipoOfertaAcademica;
use App\Models\ProductosOAView;

class OfertaAcademicaController extends Controller {

	private $urlFolder = 'documentos'.DS.'oferta_academica'.DS;
	
	public function onConstruct(){

		$this->currentUser=Users::currentUser();
		$this->view->setLayout('index');
	}
	
	public function indexAction(){
		// Lleva y muestra el listado de ofertas academicas
		$datosTOA = tipoOfertaAcademica::listarOfertas();
		$datosOA = ofertaAcademica::buscarOfertasAdemicasDelUsuario($this->currentUser->id);
		$this->view->currentUser = $this->currentUser->id;
		$this->view->datosTOA =$datosTOA;
		$this->view->datosOA =$datosOA;
		$this->view->render('ofertaAcademica/index');
	}	
	
	// Muestra datos en modal para registro tanto de nueva oferta academica como de nueva solicitud a oferta academica
	public function nuevoAction(){

		//		$empresas= Empresas::find(['order'=>'razon_social']);
		//		$arr_empresas=[];
		//		foreach($empresas as $empresa){
		//			$arr_empresas[$empresa->id]=$empresa->razon_social;
		//		}
		//		$this->view->empresas = $arr_empresas;
		
		// SI ES POST -> Voy a guardar una solicitud de interes en al oferta académica
		if($this->request->isPost()){
			
			// Me trae datos para mostrar en modal el registro de nueva oferta academica
			
			$tipo_oferta = tipoOfertaAcademica::listarOfertas();
			$arr_TO=[];
			foreach($tipo_oferta as $tipo_oferta){
				$arr_TO[$tipo_oferta->id]=$tipo_oferta->nom;
			}
			$this->view->arr_TO = $arr_TO;	
			$this->view->empresaID = $this->currentUser->id;

			//Cuando hay  ID es modificar
			if(isset($_POST['idOA']) && !empty($_POST['idOA'])){

				$ofertaAcademica = ofertaAcademica::findById((int)$_POST['idOA']);

			}else{
			//Cuando NO hay  ID es crear	
				$ofertaAcademica = new ofertaAcademica();

			}

			$this->view->ofertaAcademica = $ofertaAcademica;
			$this->view->displayErrors = $ofertaAcademica->getErrorMessages();
			$this->view->renderModal('ofertaAcademica/crear');	
			
		}else{
			
			//Me trae datos para mostrar en modal de registro de nueva solicitud de interes sobre OA
			$datos = new Ofertasoa();
			
			$OA = ofertaAcademica::findById((int)$this->request->get('OA_id'));
			$empresa = Empresas::findById((int)$OA->id_empresa);
			$datos->oa_id = $OA->id;

			$this->view->OA = $OA;
			$this->view->empresa = $empresa;
			$this->view->datos = $datos;
			$this->view->displayErrors = $datos->getErrorMessages();
			$this->view->renderModal('ofertas/crearOA');  

		}
		   


	}	
	
	public function mostrarAdjuntoAction(){
		return $this->mostrarAdjunto($_GET['urlAdjunto']);			
	}
	// Guarda nuevo tipo de oferta academico validando que no exista el nombre de la oferta
	public function guardarAction($nomTOA=""){
		
		$datosOA = new ofertaAcademica();
		$filename = '';
		$rtaProceso = true; $descError = '';
		if(isset($_FILES)){

				foreach($_FILES as $adjunto){
						$name = explode('.', $adjunto["name"]);
						//Validacion del adjunto application/pdf size < 200000 2mb 
						// Types: ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg']
						if($adjunto["size"]<=200000000 && $adjunto["type"]=='application/pdf'){

								$filename = $name[0].date('YmdHis').'.'.$name[1];
								echo 'FN:'.$filename.' Size: '.$adjunto["size"];

								if(move_uploaded_file($adjunto["tmp_name"], $this->urlFolder . $filename)){
									$rtaProceso = true; $descError = 'Se cargo el archivo correctamente.';
								}else{
									$rtaProceso = false; $descError = 'No se cargó el archivo';
								}

						}else{
							$rtaProceso = false; $descError = 'El archivo que intenta cargar supera el peso o no es de tipo PDF.';
						}
					
				}
			
		}

		
		$vectoDatos = [
			'id_empresa' => $this->request->get('txt_empresa'),
			'tipo_oferta' => $this->request->get('cmb_tipoOA'),
			'nombre' => $this->request->get('txt_nombreOA'),
			'duracion' => $this->request->get('txt_duracion'),
			'estado' => $this->request->get('cmb_estadoOA'),
			'comentarios' => $this->request->get('txt_descripcion'),
			'adjunto' => $filename
		];
		//H::dnd($vectoDatos);
		if($rtaProceso){
			
			$datosOA->assign($vectoDatos);
			$datosOA->save();
			//if($datosOA->save()){
				$rtaProceso = true; $descError = $datosOA->getErrorMessages();
			//}else{
			///	$rtaProceso = false; $descError = ' - '.$datosOA->getErrorMessages();
			//}
			
		}
		
		$resp = ['success'=>true,'errors'=>$descError];
        $this->jsonResponse($resp);
		//unset($datosOA);
		
	}
	
	public function cambiarEstadoOAAction($idOA=""){
		
		if($idOA==""){
			$idOA = $_POST["idOA"];
		}
		
		$OADatos = ofertaAcademica::findById($idOA);
		if($OADatos){
			
			if($OADatos->estado=='1'){
				$OADatos->estado='0';
			}else{
				$OADatos->estado='1';
			}
			
            if($OADatos->save()){
               $resp = ['success'=>true];
            }else{
               $resp = ['success'=>false,'errors'=>$OADatos->getErrorMessages()];
            }
			
		}else{
			
			$resp = ['success'=>false,'errors'=>$OADatos->getErrorMessages()];
			
		}
		
		$this->jsonResponse($resp);
		//unset($OADatos);
	}
		
	public function editarAction(){
		
		$id = $this->request->get('txt_idOA');
		$datosOA = OfertaAcademica::findById((int)$id);
		//$getVars = $this->request->get(); var_dump($getVars);
		//$datos->assign($this->request->get()); $datos->assign(['id'=>$id, 'nom'=>$nom]);
		$datosOA->tipo_oferta = $this->request->get('cmb_tipoOA');
		$datosOA->nombre = $this->request->get('txt_nombreOA');
		$datosOA->duracion = $this->request->get('txt_duracion');
		$datosOA->estado = $this->request->get('cmb_estadoOA');
		$datosOA->comentarios = $this->request->get('txt_descripcion');
	
		if(!$datosOA) Router::redirect('OfertaAcademica');
				

		if(isset($_FILES)){

			foreach($_FILES as $adjunto){
				$name = explode('.', $adjunto["name"]);
				//Validacion del adjunto application/pdf size < 200000 2mb 
				// Types: ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg']
				if($adjunto["size"]<=200000000 && $adjunto["type"]=='application/pdf'){

					$filename = $name[0].date('YmdHis').'.'.$name[1];
					
					//echo 'FN:'.$filename.' Size: '.$adjunto["size"];
					if(!move_uploaded_file($adjunto["tmp_name"], $this->urlFolder . $filename)){
						$filename = '';
					}
					
					$datosOA->adjunto = $filename;
				}else{
					$datosOA->adjunto = '';
				}
			}
			
			
		
		}
		//echo $filename;
		if($datosOA->save()){
			$resp = ['success'=>true,'errors'=>$datosOA->getErrorMessages()];
		}else{
			$resp = ['success'=>false,'errors'=>$datosOA->getErrorMessages()];
		}
		//var_dump($resp);
      	$this->jsonResponse($resp);

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

	public function buscarAction(){

	   if($this->request->isPost()){
		 $nomOA = '%';
		 $empresaID = '%';
		 $tipoOAId = '%';

		 if(!empty($this->request->get('txt_nomOA')))
			$nomOA = '%'.$this->request->get('txt_nomOA').'%';

		 if(!empty($this->request->get('cmb_empresa_id')))
			$empresaID = '%'.$this->request->get('cmb_empresa_id').'%';

		 if(!empty($this->request->get('cmb_tipo_oferta')))
			$tipoOAId = '%'.$this->request->get('cmb_tipo_oferta').'%';

		 $datos = ProductosOAView::find([
			'conditions'=>'nombre_oa like ? and empresa_id like  ?  and tipo_oa_id like  ?',
			'bind'=>[$nomOA, $empresaID, $tipoOAId]
		 ]);

		 $consulta = "RS: ".$this->request->get('txt_nomOA').' / '.$this->request->get('cmb_empresa_id').' / '.$this->request->get('cmb_tipo_oferta').' / POST: '.$this->request->isPost();   
		 $resp = ['success'=>true,'datos'=>$datos, 'rs'=>$consulta];
		 $this->jsonResponse($resp);
	  }else{

		 $nomOA = '%';
		 $empresaID = '%';
		 $tipoOAId = '%';

		 $datos = ProductosOAView::find([
			'conditions'=>'oferta like ? and empresa_id like  ?  and tipo_oa_id like  ?',
			'bind'=>[$nomOA, $empresaID, $tipoOAId]
		 ]);

		 $resp = ['success'=>true,'datos'=>$datos, 'rs'=>'NO ES POST'];
		 $this->jsonResponse($resp);
	  }


	}

	
	public function guardarSolicitudOAAction(){
		//var_dump($this->request->get());
		$Ofertasoa = new Ofertasoa();
		$Ofertasoa->oa_id = $this->request->get('oa_id');
		$Ofertasoa->usuario_id = $this->request->get('usuario_id');
		$Ofertasoa->descripcion = $this->request->get('descripcion');
		$Ofertasoa->fecha_reg = date('Y-m-d H:m:s');

		if($Ofertasoa->save()){
/*			$estados=new OfertasEstados();
			$estados->oferta_id=$Ofertasoa->id;
			$estados->estado=0;
			$estados->fecha_reg=date('Y-m-d H:m:s');
			$estados->save();*/
			$resp = ['success'=>true,'errors'=>$Ofertasoa->getErrorMessages()];
		}else{
			$resp = ['success'=>false,'errors'=>$Ofertasoa->getErrorMessages()];
		}
		//var_dump($resp);
		$this->jsonResponse($resp);
		
	}	
	
	
}
