<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\ResiduoClase;

class ResiduoClaseController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = ResiduoClase::find(['order'=>'clase']);
      $this->view->datos = $datos;
      $this->view->render('residuo_clase/index');
   }

   public function nuevoAction(){
      $datos = new ResiduoClase();

      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),ResiduoClase::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $this->view->datos = $datos;
         $this->view->renderModal('residuo_clase/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = ResiduoClase::findById((int)$id);
      
      if(!$datos) Router::redirect('residuo_clase');
      
      if($this->request->isPost()){
         $datos->assign($this->request->get());
      
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $this->view->datos = $datos;
         $this->view->renderModal('residuo_clase/editar');
      }
   }

   public function eliminarAction(){
      
      $id=$this->request->get('id');
      $datos = ResiduoClase::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}