<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class DemandasEstados extends Model {

	public $demanda_id,$usuario_id,$respuesta,$fecha_reg;
	protected static $_table='demandas_estados';
	const blackList = ['id'];

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'demanda_id','msg'=>'demanda_id es requerido.']));
	}
}