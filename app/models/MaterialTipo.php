<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class MaterialTipo extends Model {

  public $id,$categoria_id,$tipo;
  protected static $_table='material_tipo';
  const blackList = ['id'];

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'categoria_id','msg'=>'Categoria de material es requerido.']));
		$this->runValidation(new RequiredValidator($this,['field'=>'tipo','msg'=>'Tipo de material es requerido.']));
	}

  	public static function listarTipo(){
		$sql = "SELECT tipo.id ,categoria,tipo FROM material_tipo AS tipo
			INNER JOIN material_categoria  AS cat ON tipo.`categoria_id`=cat.id
			ORDER BY categoria,tipo";

		$db = DB::getInstance();
		if($db->query($sql)->count()>0)
			return $db->query($sql)->results();
		else
			return [];
	}
}