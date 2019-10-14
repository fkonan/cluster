<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Demandas extends Model {

	public $sector_id,$descripcion,$empresa_id,$usuario_id,$fecha_reg;
	protected static $_table='demandas';
	const blackList = ['id'];

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'sector_id','msg'=>'sector_id es requerido.']));
	}
}