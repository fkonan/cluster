<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class ResiduoCategoria extends Model {

  public $id,$clase_id,$categoria;
  protected static $_table='residuo_categoria';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'clase_id','msg'=>'Clase del residuo es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'categoria','msg'=>'Categoria del residuo es requerido.']));
  }

  public static function listarCategoria(){
  	$sql = "SELECT cat.id ,clase,categoria FROM residuo_categoria AS cat
  	INNER JOIN residuo_clase  AS clase ON cat.`clase_id`=clase.id
  	ORDER BY clase,categoria";

  	$db = DB::getInstance();
  	if($db->query($sql)->count()>0)
  		return $db->query($sql)->results();
  	else
  		return [];
  }
}