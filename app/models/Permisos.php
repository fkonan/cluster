<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\DB;
class Permisos extends Model {
	public $rol_id,$modulo_id,$acl;
	protected static $_table='permisos';
	const blackList = ['id'];
	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'rol_id','msg'=>'El ID del rol es requerido.']));
		$this->runValidation(new RequiredValidator($this,['field'=>'modulo_id','msg'=>'El ID del modulo es requerido.']));
	}
	
	public static function buscarPermiso($idRol, $idModulo){
		$sql = "SELECT COUNT(id) as rta, id as permisoID
				FROM `permisos` 
				WHERE
				rol_id=? AND modulo_id=?";
		$rta = DB::getInstance()->query($sql, [$idRol, $idModulo])->results();
		return ($rta);
	}
	
	public static function buscarPermisosRol($idRol){
		$sql = "SELECT p.id as perId, r.id as rolID, m.id as modId, r.rol as rolName, m.modulo as modNom
				FROM permisos as p
				INNER JOIN roles as r ON r.id = p.rol_id
				INNER JOIN modulos as m ON  m.id = p.modulo_id
				WHERE r.id=?";
		$rta = DB::getInstance()->query($sql, [$idRol])->results();
		return ($rta);
	}
}