<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use App\Models\Users;
use Core\Router;
use Core\H;
use App\Models\Empresas;
use App\Models\TipoEmpresa;
use App\lib\utilities\Uploads;

class EmpresasController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
      $this->currentUser=Users::currentUser();
   }

   public function validarDuplicadoAction($nombre_campo,$valor){
      $datos = Empresas::findFirst([
         'conditions'=>$nombre_campo.' = ? ',
         'bind'=>[$valor]
      ]);
      if($datos)
         $resp = ['success'=>true,'mensaje'=>'Registrese en persona natural como usuario de esta empresa o contacte con el administrador del sistema.'];
      else
         $resp = ['success'=>false];

      $this->jsonResponse($resp);
   }
   
   public function indexAction(){
      $datos = Empresas::find([
         'columns'=>'empresas.id,nit,razon_social,direccion,telefono_fijo,representante_legal,nombre_contacto,telefono_contacto,tipo_empresa,fecha_registro',
         'joins'=>
         [
           'joins'=>
           ['tipo_empresa','empresas.tipo_empresa_id=tipo_empresa.id','tipo_empresa','INNER']
         ],
         'order'=>'razon_social'
      ]);
      $this->view->datos = $datos;
      $this->view->render('empresas/index');
   }

   public function detalleAction(){
      if($this->request->isPost())
      {
         H::dnd('x');
      }
      else
      {
         $datos = Empresas::findById((int)$this->currentUser->empresa_id);
         $tipo_empresa= TipoEmpresa::find(['order'=>'tipo_empresa']);
         
         $arr_tipo_empresa=[];
         foreach($tipo_empresa as $tipo_empresa){
            $arr_tipo_empresa[$tipo_empresa->id]=$tipo_empresa->tipo_empresa;
         }

         $this->view->tipo_empresa = $arr_tipo_empresa;
         $this->view->displayErrors = $datos->getErrorMessages();
         $this->view->datos = $datos;
         $this->view->postAction = PROOT . 'empresas' . DS . 'detalle';
         $this->view->render('empresas/detalle');
      }
   }

   public function nuevoAction(){
      $datos = new Empresas();
      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get(),Empresas::blackList);

         if(isset($FILES['logo'])){
            if(!$_FILES['logo']['tmp_name']=='')
               $files['logo'] = $_FILES['logo'];

            $uploads = new Uploads($files);
            $uploads->runValidation();
            $imagesErrors = $uploads->validates();
            if(is_array($imagesErrors)){
                $msg = "";
                foreach($imagesErrors as $name => $message){
                    $msg .= $message . " ";
                }
                $datos->addErrorMessage('logo',trim($msg));
            }
         }
         $datos->fecha_registro=date('Y-m-d H:m:s');
         $datos->fecha_actualiza=date('Y-m-d H:m:s');
         if($datos->save()){
            if(isset($uploads))
            {
               $path = 'img'.DS.'empresas'.DS.$datos->nit;
               $datos=$datos->findById($datos->id);
            
               foreach($uploads->getFiles() as $key=>$file){
                  $parts = explode('.',$file['name']);
                  $ext = end($parts);
                  $uploadName = $key . '.' . $ext;
                  $datos->$key = $path.$uploadName;
                  $uploads->upload($path,$uploadName,$file['tmp_name']); 
               }
               $datos->save();
            }
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }

      $tipo_empresa= TipoEmpresa::find(['order'=>'tipo_empresa']);
      $arr_tipo_empresa=[];
      foreach($tipo_empresa as $tipo_empresa){
         $arr_tipo_empresa[$tipo_empresa->id]=$tipo_empresa->tipo_empresa;
      }

      $this->view->tipo_empresa = $arr_tipo_empresa;
      $this->view->datos = $datos;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'empresas' . DS . 'nuevo';
      $this->view->renderModal('empresas/crear');
   } 

   public function editarAction(){

      $id=$this->request->get('id');
      $datos = Empresas::findById((int)$id);
      if(!$datos) Router::redirect('empresas');

      if($this->request->isPost()){
         $this->request->csrfCheck();

         $datos->assign($this->request->get());
         $datos->fecha_actualiza=date('Y-m-d H:m:s');

         if(!empty($_FILES['logo']['tmp_name'])){

            $files['logo'] = $_FILES['logo'];
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
         }

         if($datos->save()){
            if(isset($uploads))
            {
               $path = 'img'.DS.'empresas'.DS;
               
               foreach($uploads->getFiles() as $key=>$file){
                  $parts = explode('.',$file['name']);
                  $ext = end($parts);
                  $uploadName = $datos->id.'_'.$key.'.' . $ext;
                  $datos->logo = $path.$uploadName;
                  $uploads->upload($path,$uploadName,$file['tmp_name']); 
               }
               $datos->save();
            }
            $resp = ['success'=>true];
            $this->jsonResponse($resp);
         }else{
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
            $this->jsonResponse($resp);
         }
      }

      $tipo_empresa= TipoEmpresa::find(['order'=>'tipo_empresa']);
      $arr_tipo_empresa=[];
      foreach($tipo_empresa as $tipo_empresa){
         $arr_tipo_empresa[$tipo_empresa->id]=$tipo_empresa->tipo_empresa;
      }
      $this->view->tipo_empresa = $arr_tipo_empresa;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->datos = $datos;
      $this->view->postAction = PROOT . 'empresas' . DS . 'editar' . DS . $datos->id;
      $this->view->renderModal('empresas/editar');
   }

   public function eliminarAction(){
      $id=$this->request->get('id');
      $datos = Empresas::findById((int)$id);
      if($datos){
         $datos->delete();
         $resp = ['success'=>true];
         return $this->jsonResponse($resp);
      }
   }
}