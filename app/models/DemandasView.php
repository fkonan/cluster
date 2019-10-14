<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class DemandasView extends Model {

	public $razon_social,$sector_id,$sector,$telefono_fijo,$telefono_contacto,$logo,$persona_contacto,$correo_contacto,$adjunto,$direccion;
	protected static $_table='demandas_view';
	
}