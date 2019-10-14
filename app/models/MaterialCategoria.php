<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class MaterialCategoria extends Model {

  public $id,$categoria;
  protected static $_table='material_categoria';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'categoria','msg'=>'Categoria del material es requerido.']));
  }
}