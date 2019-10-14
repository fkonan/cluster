<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class MaterialSubTipo extends Model {

  public $id,$tipo_id,$subtipo;
  protected static $_table='material_subtipo';
  const blackList = ['id'];

  public function validator(){
	$this->runValidation(new RequiredValidator($this,['field'=>'tipo_id','msg'=>'Tipo de material es requerido.']));
	$this->runValidation(new RequiredValidator($this,['field'=>'subtipo','msg'=>'Subtipo de material es requerido.']));
  }
  public static function listarSubTipo(){
  	$sql = "SELECT subtipo.id ,tipo,subtipo FROM material_subtipo AS subtipo
		INNER JOIN material_tipo AS tipo ON subtipo.`tipo_id`=tipo.id
		ORDER BY tipo,subtipo";

  	$db = DB::getInstance();
  	if($db->query($sql)->count()>0)
  		return $db->query($sql)->results();
  	else
  		return [];
  }
}