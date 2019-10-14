<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\TipoProducto;

class TipoProductoController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = TipoProducto::find(['order'=>'tipo_producto']);
      $this->view->datos = $datos;
      $this->view->render('tipo_producto/index');
   }

   public function nuevoAction(){
      $datos = new TipoProducto();
      if($this->request->isPost()){
         $datos->assign($this->request->get(),TipoProducto::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'tipoProducto' . DS . 'nuevo';
      $this->view->renderModal('tipo_producto/crear');
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = TipoProducto::findById((int)$id);
      if(!$datos) Router::redirect('tipo_producto');
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
      $this->view->postAction = PROOT . 'tipoProducto' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('tipo_producto/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = TipoProducto::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}