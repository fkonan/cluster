<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class DatosObra extends Model {

	public $empresa_id,$nombre_obra,$municipio_id,$direccion,$descripcion,$area_lote,$area_obra,$gran_generador,$licencia_demolicion,$licencia_construccion,$licencia_espacio_publico,$tipo_obra_id,$subtipo_obra_id,$fecha_inicial,$fecha_final,$plazo,$plan_manejo_rcd,$plan_aprob_autor_ambiental,$cual_autoridad,$descripcion_act_especifica,$latitud,$longitud,$documento_responsable,$nombres_responsable,$apellidos_responsable,$celular_responsable,$cargo,$correo_responsable,$estimacion_vida_util,$sotano,$volumen,$programa_manejo_ambiental;

	protected static $_table='datos_obra';

	const blackList = ['id'];

  	public function validator(){
	  	$camposRequeridos=[
	  		'empresa_id'=>"Empresa",
	  		'nombre_obra'=>"Nombre de la obra",
	  		'municipio_id'=>"Municipio",
	  		'direccion'=>"Dirección",
	  		'descripcion'=>"Descripción",
	  		'area_obra'=>"Área de la obra",
	  		'area_lote'=>"Área del lote",
	  		'fecha_inicial'=>"Fecha inicial",
	  		'fecha_final'=>"Fecha final",
	  		'documento_responsable'=>"Documento responsable",
	  		'nombres_responsable'=>"Nombres responsable",
	  		'apellidos_responsable'=>"Apellidos responsable",
	  		'cargo'=>"Cargo responsable",
	  		'tipo_obra_id'=>"Tipo de obra",
	  		'correo_responsable'=>"Correo responsable"
	  	];
	  	foreach($camposRequeridos as $campo => $msn){
	  		$this->runValidation(new RequiredValidator($this,['field'=>$campo,'msg'=>$msn." es requerido."]));
	  	}
  	}
}