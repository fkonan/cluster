<?php
namespace App\Models;
use Core\DB;
use Core\Model;
use Core\Validators\RequiredValidator;

class SubTipoObra extends Model {

	public $tipo_obra_id,$subtipo_obra;
	protected static $_table='subtipo_obra';
	const blackList = ['id'];

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'tipo_obra_id','msg'=>'Tipo de obra es requerido.']));
		$this->runValidation(new RequiredValidator($this,['field'=>'subtipo_obra','msg'=>'Subtipo de obra es requerido.']));
	}

	public static function listarSubTipoObra(){
		$sql = "SELECT subtipo_obra.id,tipo_obra,subtipo_obra FROM subtipo_obra
		INNER JOIN tipo_obra ON subtipo_obra.tipo_obra_id=tipo_obra.id
      order BY tipo_obra,subtipo_obra";

		$db = DB::getInstance();
		if($db->query($sql)->count()>0)
			return $db->query($sql)->results();
		else
			return [];
	}
}