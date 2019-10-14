<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Municipio;

class MunicipioController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = Municipio::find(['order'=>'municipio']);
      $this->view->datos = $datos;
      $this->view->render('municipio/index');
   }

   public function nuevoAction(){
      $datos = new Municipio();
      if($this->request->isPost()){
         $datos->assign($this->request->get(),Municipio::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'municipio' . DS . 'nuevo';
      $this->view->renderModal('municipio/crear');
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = Municipio::findById((int)$id);
      if(!$datos) Router::redirect('municipio');
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
      $this->view->postAction = PROOT . 'municipio' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('municipio/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = Municipio::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}