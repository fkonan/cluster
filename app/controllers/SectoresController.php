<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Sectores;

class SectoresController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = Sectores::find(['order'=>'sector']);
      $this->view->datos = $datos;
      $this->view->render('sectores/index');
   }

   public function nuevoAction(){
      $datos = new Sectores();
      if($this->request->isPost()){
         $datos->assign($this->request->get(),Sectores::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->renderModal('sectores/crear');
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = Sectores::findById((int)$id);
      if(!$datos) Router::redirect('sectores');
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
      $this->view->renderModal('sectores/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = Sectores::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}