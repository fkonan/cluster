<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\TipoEmpresa;

class TipoEmpresaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = TipoEmpresa::find(['order'=>'tipo_empresa']);
      $this->view->datos = $datos;
      $this->view->render('tipo_empresa/index');
   }

   public function nuevoAction(){
      $datos = new TipoEmpresa();
      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get(),TipoEmpresa::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'tipoEmpresa' . DS . 'nuevo';
      $this->view->renderModal('tipo_empresa/crear');
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = TipoEmpresa::findById((int)$id);
      if(!$datos) Router::redirect('tipoEmpresa');
      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get());
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->datos = $datos;
      $this->view->postAction = PROOT . 'tipoEmpresa' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('tipo_empresa/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = TipoEmpresa::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}