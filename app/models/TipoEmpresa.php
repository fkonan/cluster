<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class TipoEmpresa extends Model {

  public $tipo_empresa;
  protected static $_table='tipo_empresa';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'tipo_empresa','msg'=>'Tipo de empresa es requerido.']));
  }
}