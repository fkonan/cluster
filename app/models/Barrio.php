<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Barrio extends Model {

  public $codigo,$nombre,$codigo_comuna;
  protected static $_table='barrio';
  //const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'codigo','msg'=>'Codigo del barrio es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'nombre','msg'=>'Nombre del barrio es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'codigo_comuna','msg'=>'Codigo de la comuna es requerido.']));
  }
}