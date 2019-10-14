<?php
use Core\FH;
use Core\H;
?>
<div class="modal inmodal fade font-weight-bold" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="empresaLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title text-decoration"><u>Registrar Nueva Empresa</u></h4>
         </div>
         <div class="modal-body">
            <form method="post" action="" id="frmEmpresa" role="form">
               <!--
               Datos de la empresa
               -->
               <div class="row">
                  <?=FH::inputBlock('text','Nit','nit',$this->empresas->nit,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."empresas','validarDuplicado','nit',this);"],['class'=>'col-md-6 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Razón social','razon_social',$this->empresas->razon_social,['class'=>'form-control'],['class'=>'col-md-6'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Representante legal','representante_legal',$this->empresas->representante_legal,['class'=>'form-control'],['class'=>'col-md-6 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Dirección de la empresa','direccion',$this->empresas->direccion,['class'=>'form-control'],['class'=>'col-md-6 form-group'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Teléfono de la empresa','telefono_fijo',$this->empresas->telefono_fijo,['class'=>'form-control'],['class'=>'col-md-6 form-group'],$this->formErrors);?>
                  
                  <?=FH::inputBlock('text','Persona de contacto','nombre_contacto',$this->empresas->nombre_contacto,['class'=>'form-control'],['class'=>'col-md-6 form-group'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Teléfono de contacto','telefono_contacto',$this->empresas->telefono_contacto,['class'=>'form-control'],['class'=>'col-md-6 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Correo de contacto','correo_contacto',$this->empresas->correo_contacto,['class'=>'form-control'],['class'=>'col-md-6'],$this->formErrors);?>
               </div>
               <div class="row"> 
                  <?= FH::selectBlock('Tipo de empresa','tipo_empresa_id',$this->empresas->tipo_empresa_id,$this->tipo_empresa,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6 form-group'],$this->formErrors) ?>
                  
                  <?= FH::selectBlock('Sector al que pertenece','sector_id',$this->empresas->sector_id,$this->sectores,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6 form-group'],$this->formErrors) ?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Pagina web','pagina_web',$this->empresas->pagina_web,['class'=>'form-control'],['class'=>'col-md-6'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Descripción del ciuu','ciiu',$this->empresas->ciiu,['class'=>'form-control'],['class'=>'col-md-6'],$this->formErrors);?>
               </div>
               
               <hr>
               <!--
               Datos del usuario
               -->
               <div class="row">
                  <?= FH::selectBlock('Tipo doc. usuario','tipo_documento',$this->usuario->tipo_documento,['Cédula'=>'Cédula de ciudadanía','Cédula de extranjería'=>'Cédula de extranjería','Pasaporte'=>'Pasaporte'],['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-4'],$this->formErrors) ?>

                  <?=FH::inputBlock('text','Documento del usuario','documento',$this->usuario->documento,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."users','validarDuplicado','documento',this);"],['class'=>'col-md-4 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Nombre del usuario','nombre',$this->usuario->nombre,['class'=>'form-control'],['class'=>'col-md-4'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Apellidos del usuario','apellido',$this->usuario->apellido,['class'=>'form-control'],['class'=>'col-md-4 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Teléfono fijo','telefono_fijo_usuario',$this->usuario->telefono_fijo_usuario,['class'=>'form-control'],['class'=>'col-md-4 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('text','Teléfono celular','celular',$this->usuario->celular,['class'=>'form-control'],['class'=>'col-md-4 form-group'],$this->formErrors);?>
               </div>
               <div class="row">
                  <?=FH::inputBlock('text','Correo electrónico','correo',$this->usuario->correo,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."users','validarDuplicado','correo',this);"],['class'=>'col-md-6 form-group'],$this->formErrors);?>

                  <?=FH::inputBlock('password','Contraseña','password',$this->usuario->password,['class'=>'form-control'],['class'=>'col-md-3'],$this->formErrors);?>

                  <?=FH::inputBlock('password','Repetir contraseña','confirm',$this->usuario->confirm,['class'=>'form-control'],['class'=>'col-md-3'],$this->formErrors);?>

               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="guardarEmpresa();">Guardar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

