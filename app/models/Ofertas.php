<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Ofertas extends Model {

	public $producto_id,$usuario_id,$descripcion,$fecha_reg;
	protected static $_table='ofertas';
	const blackList = ['id'];

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'producto_id','msg'=>'Producto es requerido.']));
	}
}