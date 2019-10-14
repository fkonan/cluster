<?php
use Core\FH;
use Core\H;
?>
<div class="modal inmodal fade font-weight-bold" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="usuarioLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title text-decoration"><u>Registrar Nuevo Usuario</u></h4>
         </div>
         <div class="modal-body">
            <form method="post" action="" id="frmUsuario" role="form">
               <!--
               Datos del usuario
               -->
               <div class="row">
                  <?= FH::selectBlock('Tipo doc. usuario','tipo_documento',$this->usuario->tipo_documento,['Cédula'=>'Cédula de ciudadanía','Cédula de extranjería'=>'Cédula de extranjería','Pasaporte'=>'Pasaporte'],['class'=>'form-control','placeHolder'=>'seleccione','id'=>'tipo_documento_usuario'],['class'=>'col-md-4'],$this->formErrors) ?>

                  <?=FH::inputBlock('text','Documento del usuario','documento',$this->usuario->documento,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."users','validarDuplicado','documento',this);",'id'=>'documento_usuario'],['class'=>'col-md-4 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Nombre del usuario','nombre',$this->usuario->nombre,['class'=>'form-control','id'=>'nombre_usuario'],['class'=>'col-md-4'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Apellidos del usuario','apellido',$this->usuario->apellido,['class'=>'form-control','id'=>'apellido_usuario'],['class'=>'col-md-4 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Teléfono fijo','telefono_fijo_usuario',$this->usuario->telefono_fijo_usuario,['class'=>'form-control','id'=>'telefono_fijo_usuario2'],['class'=>'col-md-4 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Teléfono celular','celular',$this->usuario->celular,['class'=>'form-control','id'=>'celular_usuario'],['class'=>'col-md-4 form-group'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Correo electrónico','correo',$this->usuario->correo,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."users','validarDuplicado','correo',this);",'id'=>'correo_usuario'],['class'=>'col-md-6 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('password','Contraseña','password',$this->usuario->password,['class'=>'form-control','id'=>'contraseña_usuario'],['class'=>'col-md-3'],$this->formErrors);?>

                  <?=FH::inputBlock('password','Repetir contraseña','confirm',$this->usuario->confirm,['class'=>'form-control','id'=>'confirm_usuario'],['class'=>'col-md-3'],$this->formErrors);?>

               </div>
               <div class="row">
                  <div class="col-md-4">
                  <?= FH::checkboxBlock('Pertenece a una empresa?','chk_empresa',false,['class'=>""],['class'=>'i-checks pt-4'],$this->formErrors) ?>
                  </div>

                  <?= FH::selectBlock('Empresa a la que pertenece','empresa_id',$this->usuario->empresa_id,$this->cmb_empresas,['class'=>'form-control','placeHolder'=>'seleccione','id'=>'empresa_id_usuario','disabled'=>true],['class'=>'col-md-8 form-group'],$this->formErrors) ?>
               </div>


               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="guardarUsuario();">Guardar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

