<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Factura extends Model {

	public $factura_no,$cliente_id,$fecha,$fecha_notificacion;
	protected static $_table='factura';
	const blackList = ['id'];

	public function validator(){
	    $this->runValidation(new RequiredValidator($this,['field'=>'cliente_id','msg'=>"El cliente es requerido."]));
	    $this->runValidation(new RequiredValidator($this,['field'=>'fecha','msg'=>"La fecha de la factura es requerido."]));
	}
}