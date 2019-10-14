<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Roles;

class RolesController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = Roles::find(['order'=>'rol']);
      $this->view->datos = $datos;
      $this->view->render('roles/index');
   }

   public function nuevoAction(){
      $datos = new Roles();
      if($this->request->isPost()){
         $datos->assign($this->request->get(),Roles::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->renderModal('roles/crear');
   } 

   public function buscarNombreRol($usrId){
      return Roles::buscarRolUsuario($usrId);
   }

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = Roles::findById((int)$id);
      if(!$datos) Router::redirect('roles');
      
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
      $this->view->renderModal('roles/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = Roles::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}