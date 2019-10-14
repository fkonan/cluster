<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class FacturaDetalle extends Model {

	public $factura_id,$producto_id,$valor,$cantidad;
	protected static $_table='factura_detalle';
	const blackList = ['id'];

	public function validator(){
	    $this->runValidation(new RequiredValidator($this,['field'=>'producto_id','msg'=>"El producto es requerido."]));
	}
}