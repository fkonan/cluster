<?php
namespace App\Models;
use App\Models\Users;
use App\Models\UserSessions;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;

use Core\{Model,Session,Cookie,DB,H};


class Users extends Model {
   protected static $_table='usuarios'; 
   public static $currentLoggedInUser = null;
   public $id,$tipo_documento,$documento,$nombre,$apellido,$password,$correo,$telefono_fijo_usuario,$telefono_fijo,$celular,$empresa_id,$rol_id,$token,$estado = 0,$foto,$confirm,$acl='["Guest"]';
   const blackList = ['id','token','foto','confirm'];


   public function validator(){
      $camposRequeridos=[
         'tipo_documento'=>'Tipo de documento',
         'documento'=>'Documento',
         'nombre'=>"Nombres",
         'apellido'=>"Apellidos",
         'password'=>"Contraseña",
         'confirm'=>"Confirmar contraseña",
         'correo'=>"Correo eletrónico"
      ];
      foreach($camposRequeridos as $campo => $msn){
         $this->runValidation(new RequiredValidator($this,['field'=>$campo,'msg'=>$msn." es requerido."]));
      }
      $this->runValidation(new UniqueValidator($this,['field'=>'correo','msg'=>'El correo electrónico ya se encuentra registrado.']));
      $this->runValidation(new UniqueValidator($this,['field'=>'documento','msg'=>'Este documeto ya se encuentra registrado.']));
      if($this->isNew()){
         $this->runValidation(new MatchesValidator($this,['field'=>'password','rule'=>$this->confirm,'msg'=>"Las contraseñas no coinciden."]));
      }
   }

   public function beforeSave(){
      if($this->isNew()){
         $this->password = password_hash($this->password, PASSWORD_DEFAULT);
         $this->confirm = password_hash($this->confirm, PASSWORD_DEFAULT);
      }
   }

   public static function findByUsername($correo) {
      return self::findFirst(['conditions'=> "correo = ? ", 'bind'=>[$correo]]);
   }

   public static function currentUser() {
      if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
         self::$currentLoggedInUser = self::findFirst(
            [
               'conditions'=>['id = ?'],
               'bind'=>[(int)Session::get(CURRENT_USER_SESSION_NAME)]
            ]);
      }
      return self::$currentLoggedInUser;
   }

   public function login($rememberMe=false) {
      Session::set(CURRENT_USER_SESSION_NAME, $this->id);
      if($rememberMe) {
         $hash = md5(uniqid() + rand(0, 100));
         $user_agent = Session::uagent_no_version();
         Cookie::set(REMEMBER_ME_COOKIE_NAME, $hash, REMEMBER_ME_COOKIE_EXPIRY);
         $fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$this->id];
         self::$_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
         $us = new UserSessions();
         $us->assign($fields);
         $us->save();
      }
   }

   public static function loginUserFromCookie() {
      $userSession = UserSessions::getFromCookie();
      if($userSession && $userSession->user_id != '') {
         $user = self::findById((int)$userSession->user_id);
         if($user) {
            $user->login();
         }
         return $user;
      }
      return;
   }

   public function logout() {
      $userSession = UserSessions::getFromCookie();
      if($userSession) $userSession->delete();
      Session::delete(CURRENT_USER_SESSION_NAME);
      if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
         Cookie::delete(REMEMBER_ME_COOKIE_NAME);
      }
      self::$currentLoggedInUser = null;
      return true;
   }

   public function acls() {
      if(empty($this->acl)) return [];
      return json_decode($this->acl, true);
   }

   public static function addAcl($user_id,$acl){
      $user = self::findById($user_id);
      if(!$user) return false;
      $acls = $user->acls();
      if(!in_array($acl,$acls)){
         $acls[] = $acl;
         $user->acl = json_encode($acls);
         $user->save();
      }
      return true;
   }

   public static function removeAcl($user_id, $acl){
      $user = self::findById($user_id);
      if(!$user) return false;
      $acls = $user->acls();
      if(in_array($acl,$acls)){
         $key = array_search($acl,$acls);
         unset($acls[$key]);
         $user->acl = json_encode($acls);
         $user->save();
      }
      return true;
   }

   public static function usuariosPorActivar(){
      $sql = "SELECT usuarios.id AS user_id,usuarios.documento,usuarios.nombre,usuarios.apellido,usuarios.correo,usuarios.telefono_fijo,usuarios.celular,usuarios.fecha_registro,empresas.id AS empresa_id,empresas.razon_social,empresas.direccion,empresas.telefono_fijo
         FROM usuarios
         LEFT JOIN empresas ON usuarios.empresa_id=empresas.id
         WHERE usuarios.estado=0  AND rol_id NOT IN (1,2) OR rol_id IS NULL
         ORDER BY nombre,apellido";
      
      $db = DB::getInstance();
      if($db->query($sql)->count()>0)
         return $db->query($sql)->results();
      else
         return [];
   }

   public static function listarUsuarios(){
      $sql = "SELECT usuarios.id AS user_id,usuarios.documento,usuarios.nombre,usuarios.apellido,usuarios.correo,usuarios.telefono_fijo,usuarios.celular,usuarios.fecha_registro,empresas.id AS empresa_id,empresas.razon_social,empresas.direccion,empresas.telefono_fijo,usuarios.estado,rol_id,CASE WHEN roles.rol IS NULL THEN 'Sin definir' ELSE roles.rol END as rol
         FROM usuarios
         LEFT JOIN roles on usuarios.rol_id=roles.id
         LEFT JOIN empresas ON usuarios.empresa_id=empresas.id
         ORDER BY nombre,apellido";
      
      $db = DB::getInstance();
      if($db->query($sql)->count()>0)
         return $db->query($sql)->results();
      else
         return [];
   }
}
