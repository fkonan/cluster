<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class MaterialesObra extends Model {

	public $obra_id,$categoria_id,$tipo_id,$subtipo_id,$unidad_id,$cantidad_medido,$cantidad_proyectado,$usuario_id,$fecha_reg,$fecha_act;

	protected static $_table='materiales_obra';

	const blackList = ['id'];

  	public function validator(){
	  	$camposRequeridos=[
	  		'categoria_id'=>"Categoria del material",
	  		'tipo_id'=>"Tipo de material",
	  		'subtipo_id'=>"Subtipo de material",
	  		'unidad_id'=>"Unidad de medida",
	  		'cantidad_proyectado'=>"Cantidad proyectado"
	  		'cantidad_medido'=>"Cantidad medido",
	  	];
	  	foreach($camposRequeridos as $campo => $msn){
	  		$this->runValidation(new RequiredValidator($this,['field'=>$campo,'msg'=>$msn." es requerido."]));
	  	}
  	}
}