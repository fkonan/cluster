<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Login extends Model {
  public $correo, $password, $remember_me;
  protected static $_table = 'tmp_fake';

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'correo','msg'=>'Correo es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'password','msg'=>'Contraseña es requerido.']));
  }

  public function getRememberMeChecked(){
    return $this->remember_me == 'on';
  }
}
