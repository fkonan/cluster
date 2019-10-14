<?php use Core\FH; ?>
<?php $this->start('body');?>
<div class="card border-info">
   <div class="card-header text-center bg-primary text-white">
      <b>Incluir Información</b>
   </div>
   <div class="card-body pt-2">
      <form method="post" action="" id="frmEmpresas" role="form" enctype="multipart/form-data">
         <?= FH::displayErrors($this->displayErrors) ?>
         <?= FH::csrfInput() ?>
         <div class="row">
            <?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>
            
            <?= FH::inputBlock('text','Nit','nit',$this->datos->nit,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."empresas','validarDuplicado','nit',this);",'readOnly'=>true],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
            
            <?= FH::inputBlock('text','Razón social','razon_social',$this->datos->razon_social,['class'=>'form-control','readOnly'=>true],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
         </div>
         <div class="row">
            <?= FH::inputBlock('text','Dirección','direccion',$this->datos->direccion,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

            <?= FH::inputBlock('text','Teléfono fijo','telefono_fijo',$this->datos->telefono_fijo,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
         </div>
         <div class="row">
            <?= FH::inputBlock('text','Representante legal','representante_legal',$this->datos->representante_legal,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

            <?= FH::inputBlock('text','Teléfono de contaco','telefono_contacto',$this->datos->telefono_contacto,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
         </div>
         <div class="row">
            <?= FH::inputBlock('text','Persona de contacto','nombre_contacto',$this->datos->nombre_contacto,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

             <?= FH::selectBlock('Tipo de empresa','tipo_empresa_id',$this->datos->tipo_empresa_id,$this->tipo_empresa,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6'],$this->displayErrors) ?>
         </div>
         <div class="row">
            <div class="col-md-2 text-center">
               <img alt="logo" class="img-thumbnail img-fluid" src="<?=PROOT.$this->datos->logo?>">
            </div>
            <div class="col-md-10">
                 <label>Logo de la empresa</label>
                 <div class="custom-file">
                     <input id="logo" name="logo" type="file" class="custom-file-input" value="<?=$this->datos->logo?>">
                     <label for="logo"  class="custom-file-label text-truncate">
                        <?php if(empty($this->datos->logo)):?>Seleccionar logo <?php else: echo $this->datos->logo; endif;?>
                     </label>
                  </div>
            </div>
          </div>
          <div class="modal-footer">
              <?php if(empty($this->datos->id)):?>
               <button type="button" class="btn btn-primary" onClick="guardar();return;">Guardar</button>
            <?php else:?>
               <button type="button" class="btn btn-primary" onClick="actualizar();return;">Actualizar</button>
            <?php endif;?>
         </div>
      </form>
   </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>

<script>
   $('.custom-file-input').on('change', function() { 
      let fileName = $(this).val().split('\\').pop(); 
      $(this).next('.custom-file-label').addClass("selected").html(fileName); 
   });

   function actualizar(){
      if($("#frmEmpresas").valid()){
         var form = new FormData(document.getElementById("frmEmpresas"));

         if (document.getElementById("logo").files.length == 0 ) { //if the file is empty
            form.delete('logo'); //remove it from the upload data
         }

         jQuery.ajax({
            url : '<?=PROOT?>empresas/editar',
            method: "POST",
            type:"POST",
            data : form,
            contentType: false,
            cache: false,
            processData:false,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido actualizado con exito', 'success',2000);
                  setTimeout(function () {
                         window.location.href = '<?=PROOT?>empresas/detalle'; //will redirect to your blog page (an ex: blog.html)
                      }, 1500);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
                  return;
               }
            }
         });
      }
   }
 
   $("#frmEmpresas").validate({
      lang: 'es',
      rules: {
         nit: {
            required: true
         },
         razon_social: {
            required: true
         },
         direccion: {
            required: true
         },
         nombre_contacto: {
            required: true
         },
         tipo_empresa_id: {
            required: true
         }
      },
      messages: {
         nit: {
            required:"El nit es requerido."
         },
         razon_social: {
            required: 'La razón social es requerido.'
         },
         direccion: {
            required: 'La dirección es requerida.'
         },
         nombre_contacto: {
            required: 'Persona de contacto es requerida.'
         },
         tipo_empresa_id: {
            required: 'Tipo de empresa es requerido.'
         }
      }
   });
</script>
<?php $this->end(); ?>