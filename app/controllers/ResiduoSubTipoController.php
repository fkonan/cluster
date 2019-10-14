<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\ResiduoTipo;
use App\Models\ResiduoSubTipo;

class ResiduoSubTipoController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = ResiduoSubTipo::listarSubTipo();
      $this->view->datos = $datos;
      $this->view->render('residuo_subtipo/index');
   }

   public function nuevoAction(){
      $datos = new ResiduoSubTipo();
      
      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),ResiduoSubTipo::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{

         $tipo= ResiduoTipo::find(['order'=>'tipo']);
         $arr_tipo=[];
         foreach($tipo as $tipo){
            $arr_tipo[$tipo->id]=$tipo->tipo;
         }

         $this->view->datos = $datos;
         $this->view->tipo = $arr_tipo;
         $this->view->renderModal('residuo_subtipo/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = ResiduoSubTipo::findById((int)$id);
      
      if(!$datos) Router::redirect('residuo_subtipo');
      
      if($this->request->isPost()){
         $datos->assign($this->request->get());
      
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $tipo= ResiduoTipo::find(['order'=>'tipo']);
         $arr_tipo=[];
         foreach($tipo as $tipo){
            $arr_tipo[$tipo->id]=$tipo->tipo;
         }

         $this->view->datos = $datos;
         $this->view->tipo = $arr_tipo;
         $this->view->renderModal('residuo_subtipo/editar');
      }
   }

   public function eliminarAction(){
      
      $id=$this->request->get('id');
      $datos = ResiduoSubTipo::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}