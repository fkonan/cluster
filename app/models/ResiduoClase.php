<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class ResiduoClase extends Model {

  public $id,$clase;
  protected static $_table='residuo_clase';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'clase','msg'=>'Clase del residuo es requerido.']));
  }
}