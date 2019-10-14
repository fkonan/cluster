<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class TipoObra extends Model {

  public $id,$tipo_obra;
  protected static $_table='tipo_obra';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'tipo_obra','msg'=>'Tipo de obra es requerido.']));
  }
}