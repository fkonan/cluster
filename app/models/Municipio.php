<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Municipio extends Model {

  public $id,$municipio;
  protected static $_table='municipio';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'municipio','msg'=>'Municipio es requerido.']));
  }
}