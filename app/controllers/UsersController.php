<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use App\Models\Users;
use App\Models\Empresas;
use App\Models\TipoEmpresa;
use App\Models\Login;
use App\Models\Roles;
use App\Models\Sectores;
use Core\H;
use Core\Session;

class UsersController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function loginAction() {
      $loginModel = new Login();
      if($this->request->isPost()) {
         //$this->request->csrfCheck();
         $loginModel->assign($this->request->get());
         $loginModel->validator();
         if($loginModel->validationPassed()){
            $user = Users::findByUsername($this->request->get('correo'));
            if($user && password_verify($this->request->get('password'), $user->password)) {            
            
               $remember = $loginModel->getRememberMeChecked();
               $user->login($remember);
               $resp=['success'=>true,'estado'=>$user->estado];   
               $this->jsonResponse($resp);
               //Router::redirect('home');
            }  else {
               $resp=['success'=>false];
               $this->jsonResponse($resp);
               //$loginModel->addErrorMessage('username','Correo o contraseña no coinciden.');
            }
         }
      }else{

         $this->view->datos = $loginModel;
         $this->view->displayErrors = $loginModel->getErrorMessages();
         $this->view->setLayout('login');
         $this->view->render('users/login');
      }
   }

   public function logoutAction() {
      if(Users::currentUser()) {
         Users::currentUser()->logout();
      }
      Router::redirect('users/login');
   }

   public function indexAction(){
      $datos = Users::listarUsuarios();
      $roles= Roles::find([
         'conditions'=>'id NOT IN  (?,?)',
         'bind'=>[1,2],
         'order'=>'id'
      ]);
      $arr_roles=[];
      foreach($roles as $roles){
         $arr_roles[$roles->id]=$roles->rol;
      }
      $this->view->roles = $arr_roles;
      $this->view->datos =$datos;
      $this->view->render('users/index');
   }

   public function habilitarAction(){
      $datos=[];
      $datos=Users::usuariosPorActivar();
      
      $roles= Roles::find([
         'conditions'=>'id NOT IN  (?,?)',
         'bind'=>[1,2],
         'order'=>'id'
      ]);
      $arr_roles=[];
      foreach($roles as $roles){
         $arr_roles[$roles->id]=$roles->rol;
      }
      $this->view->roles = $arr_roles;
      $this->view->datos = $datos;
      $this->view->render('users/habilitar');
   }

   public function nuevoAction() {
      $usuario = new Users();
      $empresas= new Empresas();

      $tipo_empresa= TipoEmpresa::find(['order'=>'tipo_empresa']);
      $arr_tipo_empresa=[];
      foreach($tipo_empresa as $tipo_empresa){
         $arr_tipo_empresa[$tipo_empresa->id]=$tipo_empresa->tipo_empresa;
      }

      $cmb_empresas= Empresas::find(['order'=>'razon_social']);
      $arr_cmb_empresas=[];
      foreach($cmb_empresas as $cmb_empresas){
         $arr_cmb_empresas[$cmb_empresas->id]=$cmb_empresas->razon_social;
      }

      $sectores= Sectores::find(['order'=>'sector']);
      $arr_sectores=[];

      foreach($sectores as $sectores){
         $arr_sectores[$sectores->id]=$sectores->sector;
      }

      $this->view->usuario = $usuario;
      $this->view->tipo_empresa = $arr_tipo_empresa;
      $this->view->empresas = $empresas;
      $this->view->cmb_empresas = $arr_cmb_empresas;
      $this->view->sectores = $arr_sectores;


      $this->view->setLayout('registro');
      $this->view->postAction = PROOT . 'users' . DS . 'nuevo';
      $this->view->displayErrors = $usuario->getErrorMessages();
      $this->view->formErrors = $empresas->getErrorMessages();

      $this->view->render('users/crear');
   }

   public function validarDuplicadoAction($nombre_campo,$valor){
      $datos = Users::findFirst([
         'conditions'=>$nombre_campo.' = ? ',
         'bind'=>[$valor]
      ]);
      if($datos)
         $resp = ['success'=>true,'mensaje'=>'Registre otro valor diferente o contacte con el administrador del sistema.'];
      else
         $resp = ['success'=>false];

      $this->jsonResponse($resp);
   }

   public function guardarEmpresaAction(){
      if($this->request->isPost()){

         $resp = ['success'=>false];
         $empresas=new Empresas();
         $empresas->assign($this->request->get(),Empresas::blackList);
         $empresas->fecha_registro=date('Y-m-d H:m:s');
         $empresas->fecha_actualiza=date('Y-m-d H:m:s');
         $empresas->validator();

         if($empresas->validationPassed())
         {
            $usuario=new Users();
            $usuario->assign($this->request->get(),Users::blackList);
            $usuario->confirm=$this->request->get('confirm');
            $usuario->fecha_registro=date('Y-m-d H:m:s');
            $usuario->fecha_actualiza=date('Y-m-d H:m:s');
            $usuario->telefono_fijo=$usuario->telefono_fijo_usuario;
            $usuario->estado=(int)0;

            $usuario->validator();

            if($usuario->validationPassed()){
                 
               if($empresas->save())
               {
                  $usuario->empresa_id=$empresas->id;

                  if($usuario->save()){
                     $resp = ['success'=>true];
                  }else {
                     $resp = ['success'=>false,'errors'=>$usuario->getErrorMessages()];
                  }

               }else{
                  $error=$empresas->getErrorMessages();
                  $resp=['success'=>false,'error'=>$error];
               }   
            }else{
               var_dump($usuario->getErrorMessages());
               H::dnd($usuario);
               $error=$empresas->getErrorMessages();
               $resp=['success'=>false,'error'=>$error];
            }
         }else{
            $resp = ['success'=>false,'errors'=>$empresas->getErrorMessages()];
         }
         $this->jsonResponse($resp);
      }
   }

   public function guardarUsuarioAction(){
      if($this->request->isPost()){

         $resp = ['success'=>false];
         
         $usuario=new Users();
         $usuario->assign($this->request->get(),Users::blackList);
         $usuario->confirm=$this->request->get('confirm');

         $usuario->fecha_registro=date('Y-m-d H:m:s');
         $usuario->fecha_actualiza=date('Y-m-d H:m:s');
         $usuario->telefono_fijo=$usuario->telefono_fijo_usuario;

         $usuario->estado=(int)0;
         $usuario->validator();
         
         if($usuario->validationPassed()){
            if($usuario->save())
            {
               $resp = ['success'=>true];
            }else{
               $error=$usuario->getErrorMessages();
               $resp=['success'=>false,'error'=>$error];
            }   
         }else{
            $error = $usuario->validates();
            if(is_array($error)){
               $msg = "";
               foreach($error as $name => $message){
                  $msg .= $message . " ";
               }
            }
            //$error=$empresas->getErrorMessages();
            $resp=['success'=>false,'error'=>$msg];
         }
         $this->jsonResponse($resp);
      }
   }

   public function editarAction($id){
      $newUser = Users::findById((int)$id);
      if(!$newUser) Router::redirect('users');
      if($this->request->isPost()){
         $this->request->csrfCheck();
         $newUser->assign($this->request->get(),['password']);
         if($newUser->save()){
            Router::redirect('users');
         }
      }
      $newUser->confirm=$newUser->password;
      $this->view->displayErrors = $newUser->getErrorMessages();
      $this->view->newUser = $newUser;
      $this->view->postAction = PROOT . 'users' . DS . 'editar' . DS . $newUser->id;
      $this->view->render('users/editar');
   }

   public function eliminarAction($id){
      $user = Users::findById((int)$id);
      if($user){
         $user->delete();
         Session::addMsg('success','Usuario inactivado correctamente.');
      }
      Router::redirect('users');
   }

   public function buscarPorIdAction(){
      if($this->request->isPost()){
        $id = (int)$this->request->get('id');
        $datos = Users::findById($id);
        $resp = ['success'=>false];
        if($datos){
          $resp['success'] = true;
          $resp['datos'] = $datos->data();
        }
        $this->jsonResponse($resp);
      }
   }

   public function habilitarUsuarioAction(){
      if($this->request->isPost()){
         $resp = ['success'=>false];
         $id =(int) $this->request->get('id');
         $datos = Users::findById($id);
         
         if($datos){
            $datos->rol_id=(int)$this->request->get('rol_id');
            $rol=Roles::findById((int)$this->request->get('rol_id'));
            $datos->estado=1;
            $datos->confirm=$datos->password;
            $datos->fecha_actualiza=date('Y-m-d H:m:s');
            if($datos->save()){
               $resp = ['success'=>true];
            }else{
               $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
            }
        }
        $this->jsonResponse($resp);
      }
   }

   public function inhabilitarUsuarioAction(){
      if($this->request->isPost()){
         $resp = ['success'=>false];
         $id =(int) $this->request->get('id');
         $datos = Users::findById($id);
         if($datos){
            $datos->estado=0;
            $datos->confirm=$datos->password;
            $datos->fecha_actualiza=date('Y-m-d H:m:s');
            if($datos->save()){
               $resp = ['success'=>true];
            }else{
               $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
            }
        }
        $this->jsonResponse($resp);
      }
   }
}
