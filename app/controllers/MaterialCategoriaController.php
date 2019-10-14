<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\MaterialCategoria;

class MaterialCategoriaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      $datos = MaterialCategoria::find(['order'=>'categoria']);
      $this->view->datos = $datos;
      $this->view->render('material_categoria/index');
   }

   public function nuevoAction(){
      $datos = new MaterialCategoria();

      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),MaterialCategoria::blackList);
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $this->view->datos = $datos;
         $this->view->renderModal('material_categoria/crear');
      }
   } 

   public function editarAction(){
      $id=$this->request->get('id');
      $datos = MaterialCategoria::findById((int)$id);
      
      if(!$datos) Router::redirect('material_categoria');
      
      if($this->request->isPost()){
         $datos->assign($this->request->get());
      
         if($datos->save())
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);

      }else{
         
         $this->view->datos = $datos;
         $this->view->renderModal('material_categoria/editar');
      }
   }

   public function eliminarAction(){
      
      $id=$this->request->get('id');
      $datos = MaterialCategoria::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}