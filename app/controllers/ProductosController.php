<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Productos;
use App\Models\TipoProducto;
use App\Models\Modulos;
use App\Models\Users;

class ProductosController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
      $this->currentUser=Users::currentUser();
   }

   public function indexAction(){
      $datos = Productos::listarProductos($this->currentUser->empresa_id);
      $this->view->datos = $datos;
      $this->view->render('productos/index');
   }

   public function nuevoAction(){
      $datos = new Productos();
      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get(),Productos::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }else{
         
         $tipo_producto= TipoProducto::find(['order'=>'tipo_producto']);
         $arr_tipo_producto=[];
         foreach($tipo_producto as $tipo_producto){
            $arr_tipo_producto[$tipo_producto->id]=$tipo_producto->tipo_producto;
         }

         $modulo= Modulos::find(['order'=>'modulo']);
         $arr_modulo=[];
         foreach($modulo as $modulo){
            $arr_modulo[$modulo->id]=$modulo->modulo;
         }

         $this->view->tipo_producto = $arr_tipo_producto;
         $this->view->modulo = $arr_modulo;
         $this->view->datos = $datos;
         $this->view->displayErrors = $datos->getErrorMessages();
         $this->view->postAction = PROOT . 'productos' . DS . 'nuevo';
         $this->view->renderModal('productos/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = Productos::findById((int)$id);
      if(!$datos) Router::redirect('productos');
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
      $this->view->postAction = PROOT . 'productos' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('productos/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = Productos::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}