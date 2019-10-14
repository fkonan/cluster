<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\MaterialTipo;
use App\Models\MaterialCategoria;

class MaterialTipoController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = MaterialTipo::listarTipo();
      $this->view->datos = $datos;
      $this->view->render('material_tipo/index');
   }

   public function nuevoAction(){
      $datos = new MaterialTipo();
      
      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),MaterialTipo::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{

         $categoria= MaterialCategoria::find(['order'=>'categoria']);
         $arr_categoria=[];
         foreach($categoria as $categoria){
            $arr_categoria[$categoria->id]=$categoria->categoria;
         }

         $this->view->datos = $datos;
         $this->view->categoria = $arr_categoria;
         $this->view->renderModal('material_tipo/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = MaterialTipo::findById((int)$id);
      
      if(!$datos) Router::redirect('material_tipo');
      
      if($this->request->isPost()){
         $datos->assign($this->request->get());
      
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $categoria= MaterialCategoria::find(['order'=>'categoria']);
         $arr_categoria=[];
         foreach($categoria as $categoria){
            $arr_categoria[$categoria->id]=$categoria->categoria;
         }

         $this->view->datos = $datos;
         $this->view->categoria = $arr_categoria;
         $this->view->renderModal('material_tipo/editar');
      }
   }

   public function eliminarAction(){
      
      $id=$this->request->get('id');
      $datos = MaterialTipo::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}