<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\MaterialSubTipo;
use App\Models\MaterialTipo;

class MaterialSubTipoController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = MaterialSubTipo::listarSubTipo();
      $this->view->datos = $datos;
      $this->view->render('material_subtipo/index');
   }

   public function nuevoAction(){
      $datos = new MaterialSubTipo();
      
      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),MaterialTipo::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{

         $tipo= MaterialTipo::find(['order'=>'tipo']);
         $arr_tipo=[];
         foreach($tipo as $tipo){
            $arr_tipo[$tipo->id]=$tipo->tipo;
         }
         
         $this->view->datos = $datos;
         $this->view->tipo = $arr_tipo;
         $this->view->renderModal('material_subtipo/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = MaterialSubTipo::findById((int)$id);
      
      if(!$datos) Router::redirect('material_subtipo');
      
      if($this->request->isPost()){
         $datos->assign($this->request->get());
      
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $tipo= MaterialTipo::find(['order'=>'tipo']);
         $arr_tipo=[];
         foreach($tipo as $tipo){
            $arr_tipo[$tipo->id]=$tipo->tipo;
         }
         
         $this->view->datos = $datos;
         $this->view->tipo = $arr_tipo;
         $this->view->renderModal('material_subtipo/editar');
      }
   }

   public function eliminarAction(){
      
      $id=$this->request->get('id');
      $datos = MaterialSubTipo::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}