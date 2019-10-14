<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class TipoProducto extends Model {

  public $id,$tipo_producto;
  protected static $_table='tipo_producto';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'tipo_producto','msg'=>'El tipo de producto del es requerido.']));
  }
}