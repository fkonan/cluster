<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Empresas extends Model {

  public $nit,$razon_social,$direccion,$telefono_fijo,$representante_legal,$nombre_contacto,$telefono_contacto,$tipo_empresa_id,$logo,$fecha_registro,$fecha_actualiza,$sector_id,$ciiu,$pagina_web,$correo_contacto;
  protected static $_table='empresas';
  const blackList = ['id'];

  public function validator(){
    $this->runValidation(new RequiredValidator($this,['field'=>'nit','msg'=>'Nit es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'razon_social','msg'=>'Razón social es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'direccion','msg'=>'Dirección es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'nombre_contacto','msg'=>'Nombre de contacto es requerido.']));
    $this->runValidation(new RequiredValidator($this,['field'=>'tipo_empresa_id','msg'=>'Tipo de empresa es requerido.']));
  }
}