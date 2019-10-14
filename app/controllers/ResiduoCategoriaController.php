<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\ResiduoClase;
use App\Models\ResiduoCategoria;

class ResiduoCategoriaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = ResiduoCategoria::listarCategoria();
      $this->view->datos = $datos;
      $this->view->render('residuo_categoria/index');
   }

   public function nuevoAction(){
      $datos = new ResiduoCategoria();
      
      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),ResiduoCategoria::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{

         $clase= ResiduoClase::find(['order'=>'clase']);
         $arr_clase=[];
         foreach($clase as $clase){
            $arr_clase[$clase->id]=$clase->clase;
         }

         $this->view->datos = $datos;
         $this->view->clase = $arr_clase;
         $this->view->renderModal('residuo_categoria/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = ResiduoCategoria::findById((int)$id);
      
      if(!$datos) Router::redirect('residuo_categoria');
      
      if($this->request->isPost()){
         $datos->assign($this->request->get());
      
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $clase= ResiduoClase::find(['order'=>'clase']);
         $arr_clase=[];
         foreach($clase as $clase){
            $arr_clase[$clase->id]=$clase->clase;
         }

         $this->view->datos = $datos;
         $this->view->clase = $arr_clase;
         $this->view->renderModal('residuo_categoria/editar');
      }
   }

   public function eliminarAction(){
      
      $id=$this->request->get('id');
      $datos = ResiduoCategoria::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}