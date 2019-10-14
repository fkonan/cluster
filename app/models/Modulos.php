<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\DB;

class Modulos extends Model {
  public $id,$modulo;
  protected static $_table='modulos';
  const blackList = ['id'];
	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'modulo','msg'=>'Rol del es requerido.']));
	}
	
	public static function buscarModulos(){
		$sql = "SELECT * FROM modulos";
		$rta = DB::getInstance()->query($sql)->results();
		return ($rta);
	}
	
	public static function buscarModulosRol($rolId){
		$sql = "SELECT p.id as permisoId, r.id as rolId, r.rol as rolNombre, m.id as idModulo, m.modulo as nomModulo 
				FROM `permisos` as p
				INNER JOIN roles as r ON p.rol_id=r.id
				INNER JOIN modulos as m ON p.modulo_id = m.id
				WHERE
				p.rol_id = ?";
		$rta = DB::getInstance()->query($sql, [$rolId])->results();
		return ($rta);
	}
	
}