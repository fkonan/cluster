<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
/*
CREATE VIEW 
ofertasAcademicas_view AS 
SELECT e.id as empresa_id, e.nit, e.razon_social, e.direccion, e.telefono_fijo, e.nombre_contacto, e.telefono_contacto, e.representante_legal, e.logo, e.tipo_empresa_id, e.pagina_web, te.tipo_empresa, e.sector_id, sec.sector, e.correo_contacto, oa.id as oa_id, oa.nombre as nombre_oa, toa.id as tipo_oa_id, toa.nom as nombre_toa, oa.duracion, oa.estado, oa.comentarios, oa.adjunto
FROM `oferta_academica` AS oa
INNER JOIN empresas as e ON e.id = oa.id_empresa
INNER JOIN tipo_oferta AS toa ON toa.id = oa.tipo_oferta
INNER JOIN tipo_empresa AS te ON te.id = e.tipo_empresa_id
INNER JOIN sectores AS sec ON sec.id = e.sector_id
*/
class ProductosOAView extends Model {
	public $razon_social, $empresa_id, $sector_id, $sector, $telefono_fijo, $telefono_contacto, $logo, $nombre_contacto, $correo_contacto, $oferta_id, $oferta, $tipo_oa_id, $adjunto, $direccion;
	protected static $_table='ofertasacademicas_view';
	
}