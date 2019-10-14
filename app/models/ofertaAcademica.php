<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\DB;
class ofertaAcademica extends Model {
	public $id, $id_empresa, $tipo_oferta, $nombre, $duracion, $estado, $comentarios, $adjunto;
	protected static $_table='oferta_academica';
	const blackList = ['id'];
	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'tipo_oferta','msg'=>'Debe seleccionar un tipo de oferta.']));
		$this->runValidation(new RequiredValidator($this,['field'=>'nombre','msg'=>'Debe seleccionar un nombre para la oferta.']));
		$this->runValidation(new RequiredValidator($this,['field'=>'duracion','msg'=>'Debe seleccionar una duración.']));
	}
	
	public static function buscarOfertasAdemicasDelUsuario($idEmpresa){
		
		$sql = "SELECT OA.id, OA.nombre as ofertaNombre, OA.duracion, OA.estado, OA.adjunto, OA.comentarios, E.razon_social as empresa, E.nit, E.direccion, E.telefono_fijo, 		 E.nombre_contacto, E.telefono_contacto, E.logo, E.pagina_web, E.correo_contacto, SEC.sector
		FROM oferta_academica as OA
		INNER JOIN empresas as E ON OA.id_empresa = E.id
		INNER JOIN tipo_oferta as TOA ON OA.tipo_oferta = TOA.id
		INNER JOIN sectores as SEC on SEC.id = E.sector_id
		WHERE OA.id_empresa=?";
		
		$rta = DB::getInstance()->query($sql, [$idEmpresa])->results();
		return ($rta);
		
	}
}