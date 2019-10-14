<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class ProductosView extends Model {

	public $razon_social,$sector_id,$sector,$modulo_id,$modulo,$telefono_fijo,$telefono_contacto,$logo,$persona_contacto,$correo_contacto,$productos_id,$producto,$adjunto,$direccion;
	protected static $_table='productos_view';
	
}