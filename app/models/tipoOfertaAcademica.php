<?php
namespace App\Models;
use Core\{Model,Session,Cookie,DB,H};
use Core\Validators\RequiredValidator;
class tipoOfertaAcademica extends Model {
	public $id, $nom;
	protected static $_table='tipo_oferta';
	const blackList = ['id'];
	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'nom','msg'=>'Debe seleccionar nombre para el tipo de oferta académica.']));
	}
	 
   public static function listarOfertas($idTipoOferta='', $nomTipoOferta=''){
      $sql = "SELECT * FROM ".self::$_table;
	 /*
	  if($idTipoOferta!='' && $nomTipoOferta=''){
		  $sql .= " WHERE id='".$idTipoOferta."' AND nom='".$nomTipoOferta."'";
	  }else if($idTipoOferta!='' && $nomTipoOferta==''){
		  $sql .= " WHERE id='".$idTipoOferta."'";
	  }else if($idTipoOferta=='' && $nomTipoOferta!=''){
		  $sql .= " WHERE nom='".$nomTipoOferta."'";
	  }
	  */
      $sql .= " ORDER BY nom";
	   
      $db = DB::getInstance();
	  //return $sql;
      if($db->query($sql)->count()>0)
         return $db->query($sql)->results();
      else
         return [];
   }
	
	public static function buscarOfertaAcademica($nomTOA){
		$sql = "SELECT id, nom AS nombre
				FROM ".self::$_table." 
				WHERE
				nom=?";
		$rta = DB::getInstance()->query($sql, [$nomTOA])->results();
		return ($rta);
	}
	
	public static function validaEliminable($idTOA){
		
		$sql = "SELECT COUNT(id) as cantidadProductos 
				FROM `oferta_academica` 
				WHERE
				tipo_oferta = ?";
		$rta = DB::getInstance()->query($sql, [$idTOA])->results();
		//echo "<br><br><br><br>";
		//var_dump($rta);
		return $rta[0]->cantidadProductos;
		
	}
	
	public static function modificarTOA($idTOA, $nomTOA){
		
		$sql = "UPDATE tipo_oferta SET nom = '?'
				WHERE
				id = ?";
		$rta = DB::getInstance()->query($sql, [$nomTOA, $idTOA])->results();
		//echo "<br><br><br><br>ID: ".$idTOA."<br><br>NOM: ".$nomTOA."<br><br>SQL: ".$sql."<br><br>";
		return $rta;
		//return $rta[0]->cantidadProductos;
		
	}
	
}