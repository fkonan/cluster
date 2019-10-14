<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\DB;
class Roles extends Model {
  public $id,$rol;
  protected static $_table='roles';
  const blackList = ['id'];
  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'rol','msg'=>'Rol del es requerido.']));
  }
	
	public static function buscarRolUsuario($usrId){
		$sql = "SELECT rol as nomRol 
				FROM ".static::$_table." 
				WHERE id=?";
		$rta = DB::getInstance()->query($sql, [$usrId])->results();
		return ($rta);
	}
}