<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Ofertasoa extends Model {
	public $oa_id, $usuario_id, $descripcion, $fecha_reg;
	protected static $_table='ofertasoa';
	const blackList = ['id'];
	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'oa_id','msg'=>'Oferta academica es requerida.']));
	}
}