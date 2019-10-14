<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Sectores extends Model {

  public $sector;
  protected static $_table='sectores';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'sector','msg'=>'El sector es requerido.']));
  }
}