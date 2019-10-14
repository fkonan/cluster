<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Adjuntos;
use App\Models\Users;
use App\lib\utilities\Uploads;

class AdjuntosController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
      $this->currentUser=Users::currentUser();
   }

   public function aguaAction(){
      $datos = Adjuntos::find([
         'conditions'=>'modulo_id= ? ',
         'bind'=>['3'],
         'order'=>'fecha_reg'
      ]);
      $this->view->datos = $datos;
      $this->view->color = 'agua-bg';
      $this->view->render('adjuntos/index_agua');
   }

   public function aguaNuevoAction(){
      $datos = new Adjuntos();
      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),Adjuntos::blackList);
         
         $datos->modulo_id=3;
         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');
         $datos->fecha_act=date('Y-m-d H:m:s');
         
         if(!empty($_FILES['archivo']['tmp_name'])){

            $files['archivo'] = $_FILES['archivo'];
            $uploads = new Uploads($files);
            $uploads->runValidation();
            $imagesErrors = $uploads->validates();
            
            if(is_array($imagesErrors)){
               $msg = "";
               foreach($imagesErrors as $name => $message){
                  $msg .= $message . " ";
               }
               $resp = ['success'=>false,'errors'=>$msg];
               $this->jsonResponse($resp);
               return;
            }
         }else{
            $resp = ['success'=>false,'errors'=>'Debe adjuntar un archivo para continuar.'];
            $this->jsonResponse($resp);
            return;
         }

         if($datos->save()){
            
            $path = 'documentos'.DS.'agua'.DS;
            
            foreach($uploads->getFiles() as $key=>$file){
               $parts = explode('.',$file['name']);
               $ext = end($parts);
               $uploadName = $datos->id.'_'.$key.'.' . $ext;
               $datos->tipo_archivo=$ext;
               $datos->archivo = $path.$uploadName;
               $uploads->upload($path,$uploadName,$file['tmp_name']); 
            }

            $datos->save();
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->renderModal('adjuntos/crear');
   }

   public function aguaEditarAction(){
      $id=$this->request->get('id');
      $datos = Adjuntos::findById((int)$id);
      if(!$datos) Router::redirect('adjuntos/agua');
      if($this->request->isPost()){

         $datos->assign($this->request->get());
         
         $datos->modulo_id=3;
         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');
         $datos->fecha_act=date('Y-m-d H:m:s');
         
         if(!empty($_FILES['archivo']['tmp_name'])){

            $files['archivo'] = $_FILES['archivo'];
            $uploads = new Uploads($files);
            $uploads->runValidation();
            $imagesErrors = $uploads->validates();
            
            if(is_array($imagesErrors)){
               $msg = "";
               foreach($imagesErrors as $name => $message){
                  $msg .= $message . " ";
               }
               $resp = ['success'=>false,'errors'=>$msg];
               $this->jsonResponse($resp);
               return;
            }
         }else{
            $resp = ['success'=>false,'errors'=>'Debe adjuntar un archivo para continuar.'];
            $this->jsonResponse($resp);
            return;
         }

         if($datos->save()){
            
            $path = 'documentos'.DS.'agua'.DS;
            
            foreach($uploads->getFiles() as $key=>$file){
               $parts = explode('.',$file['name']);
               $ext = end($parts);
               $uploadName = $datos->id.'_'.$key.'.' . $ext;
               $datos->tipo_archivo=$ext;
               $datos->archivo = $path.$uploadName;
               $uploads->upload($path,$uploadName,$file['tmp_name']); 
            }

            $datos->save();
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->renderModal('adjuntos/editar');
   }

   public function arquitecturaAction(){
      $datos = Adjuntos::find([
         'conditions'=>'modulo_id= ? ',
         'bind'=>['1'],
         'order'=>'fecha_reg'
      ]);
      $this->view->datos = $datos;
      $this->view->color = 'agua-bg';
      $this->view->render('adjuntos/index_arquitectura');
   }

   public function arquitecturaNuevoAction(){
      $datos = new Adjuntos();
      if($this->request->isPost()){
         
         $datos->assign($this->request->get(),Adjuntos::blackList);
         
         $datos->modulo_id=1;
         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');
         $datos->fecha_act=date('Y-m-d H:m:s');
         
         if(!empty($_FILES['archivo']['tmp_name'])){

            $files['archivo'] = $_FILES['archivo'];
            $uploads = new Uploads($files);
            $uploads->runValidation();
            $imagesErrors = $uploads->validates();
            
            if(is_array($imagesErrors)){
               $msg = "";
               foreach($imagesErrors as $name => $message){
                  $msg .= $message . " ";
               }
               $resp = ['success'=>false,'errors'=>$msg];
               $this->jsonResponse($resp);
               return;
            }
         }else{
            $resp = ['success'=>false,'errors'=>'Debe adjuntar un archivo para continuar.'];
            $this->jsonResponse($resp);
            return;
         }

         if($datos->save()){
            
            $path = 'documentos'.DS.'arquitectura'.DS;
            
            foreach($uploads->getFiles() as $key=>$file){
               $parts = explode('.',$file['name']);
               $ext = end($parts);
               $uploadName = $datos->id.'_'.$key.'.' . $ext;
               $datos->tipo_archivo=$ext;
               $datos->archivo = $path.$uploadName;
               $uploads->upload($path,$uploadName,$file['tmp_name']); 
            }

            $datos->save();
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->renderModal('adjuntos/crear');
   }

   public function arquitecturaEditarAction(){
      $id=$this->request->get('id');
      $datos = Adjuntos::findById((int)$id);
      if(!$datos) Router::redirect('adjuntos/arquitectura');
      if($this->request->isPost()){

         $datos->assign($this->request->get());
         
         $datos->modulo_id=1;
         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');
         $datos->fecha_act=date('Y-m-d H:m:s');
         
         if(!empty($_FILES['archivo']['tmp_name'])){

            $files['archivo'] = $_FILES['archivo'];
            $uploads = new Uploads($files);
            $uploads->runValidation();
            $imagesErrors = $uploads->validates();
            
            if(is_array($imagesErrors)){
               $msg = "";
               foreach($imagesErrors as $name => $message){
                  $msg .= $message . " ";
               }
               $resp = ['success'=>false,'errors'=>$msg];
               $this->jsonResponse($resp);
               return;
            }
         }else{
            $resp = ['success'=>false,'errors'=>'Debe adjuntar un archivo para continuar.'];
            $this->jsonResponse($resp);
            return;
         }

         if($datos->save()){
            
            $path = 'documentos'.DS.'arquitectura'.DS;
            
            foreach($uploads->getFiles() as $key=>$file){
               $parts = explode('.',$file['name']);
               $ext = end($parts);
               $uploadName = $datos->id.'_'.$key.'.' . $ext;
               $datos->tipo_archivo=$ext;
               $datos->archivo = $path.$uploadName;
               $uploads->upload($path,$uploadName,$file['tmp_name']); 
            }

            $datos->save();
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }
      
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->renderModal('adjuntos/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = Adjuntos::findById((int)$id);
      
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}