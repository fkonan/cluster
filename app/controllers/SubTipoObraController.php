<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\TipoObra;
use App\Models\SubTipoObra;

class SubTipoObraController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = SubTipoObra::listarSubTipoObra();
      $this->view->datos = $datos;
      $this->view->render('subtipo_obra/index');
   }

   public function nuevoAction(){
      $datos = new SubTipoObra();
      if($this->request->isPost()){
         $datos->assign($this->request->get(),SubTipoObra::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $tipo_obra= TipoObra::find(['order'=>'tipo_obra']);
      $arr_tipo_obra=[];
      foreach($tipo_obra as $tipo_obra){
         $arr_tipo_obra[$tipo_obra->id]=$tipo_obra->tipo_obra;
      }

      $this->view->datos = $datos;
      $this->view->tipo_obra = $arr_tipo_obra;
      $this->view->postAction = PROOT . 'subtipo_obra' . DS . 'nuevo';
      $this->view->renderModal('subtipo_obra/crear');
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = SubTipoObra::findById((int)$id);
      if(!$datos) Router::redirect('subtipo_obra');
      if($this->request->isPost()){
         $datos->assign($this->request->get());
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $tipo_obra= TipoObra::find(['order'=>'tipo_obra']);
      $arr_tipo_obra=[];
      foreach($tipo_obra as $tipo_obra){
         $arr_tipo_obra[$tipo_obra->id]=$tipo_obra->tipo_obra;
      }

      $this->view->datos = $datos;
      $this->view->tipo_obra = $arr_tipo_obra;
      $this->view->postAction = PROOT . 'subtipo_obra' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('subtipo_obra/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = SubTipoObra::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}