<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Adjuntos extends Model {

  public $modulo_id,$titulo,$descripcion,$autor,$tipo_archivo,$archivo,$usuario_id,$fecha_reg,$fecha_act;
  protected static $_table='adjuntos';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'titulo','msg'=>'El titulo del adjunto es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'descripcion','msg'=>'La Descripción es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'autor','msg'=>'El Autor es requerido.']));
    //$this->runValidation(new RequiredValidator($this,['field'=>'archivo','msg'=>'El documento adjunto es requerido.']));
  }
}