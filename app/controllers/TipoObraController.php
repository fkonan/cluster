<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\TipoObra;

class TipoObraController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = TipoObra::find(['order'=>'tipo_obra']);
      $this->view->datos = $datos;
      $this->view->render('tipo_obra/index');
   }

   public function nuevoAction(){
      $datos = new TipoObra();
      if($this->request->isPost()){
         $datos->assign($this->request->get(),TipoObra::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'tipo_obra' . DS . 'nuevo';
      $this->view->renderModal('tipo_obra/crear');
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = TipoObra::findById((int)$id);
      if(!$datos) Router::redirect('tipo_obra');
      if($this->request->isPost()){
         $datos->assign($this->request->get());
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->datos = $datos;
      $this->view->postAction = PROOT . 'tipo_obra' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('tipo_obra/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = TipoObra::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}