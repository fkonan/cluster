<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class OfertasEstados extends Model {

	public $oferta_id,$estado,$respuesta,$fecha_reg;
	protected static $_table='ofertas_estados';
	const blackList = ['id'];

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'oferta_id','msg'=>'oferta_id es requerido.']));
	}
}