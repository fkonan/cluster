<?php
namespace App\Models;
use Core\Model;
use Core\DB;
use Core\Validators\RequiredValidator;

class Productos extends Model {

  public $id,$tipo_producto_id,$producto,$ciiu,$adjunto,$modulo_id,$empresa_id,$usuario_id,$fecha_reg,$fecha_act;
  protected static $_table='productos';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'tipo_producto_id','msg'=>'El tipo de producto del es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'producto','msg'=>'El nombre del producto es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'modulo_id','msg'=>'El modulo es requerido.']));
  }

  public static function listarProductos($empresa_id){
  	$sql = "SELECT tipo_producto,producto,ciiu,adjunto,modulo,fecha_reg
  	FROM productos 
  	INNER JOIN tipo_producto on productos.tipo_producto_id=tipo_producto.id
  	INNER JOIN modulos ON productos.modulo_id=modulos.id
  	WHERE empresa_id= ?
  	ORDER BY producto;";
    $db = DB::getInstance();
    return $db->query($sql,[(int)$empresa_id])->results();
  }
}