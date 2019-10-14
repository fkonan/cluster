<?php $this->setSiteTitle('Listado de empresas')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/footable/footable.standalone.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-info">
   <div class="card-header text-center bg-success text-white">
      Listado de empresas
   </div>
   <div class="card-body pt-2">
      <a href="#" onClick="nuevo();" class="btn btn-info btn-md float-right mb-2">Nuevo registro</a>
      <div class="table-responsive">
         <table class="table table-striped table-condensed table-bordered table-hover">
            <thead class=" text-center">
               <th class="col-auto bg-success">Nit</th>
               <th class="col-auto bg-success">Razón social</th>
               <th class="col-auto bg-success">Dirección</th>
               <th class="col-auto bg-success">Teléfono fijo</th>
               <th class="col-auto bg-success">Representante legal</th>
               <th class="col-auto bg-success">Persona de contacto</th>
               <th class="col-auto bg-success">Teléfono de contacto</th>
               <th class="col-auto bg-success">Tipo de empresa</th>
               <th class="col-auto bg-success">Fecha de registro</th>
               <th class="col-auto bg-success" data-filterable="false">Acciones</th>
            </thead>
            <tbody>
               <?php foreach($this->datos as $datos): ?>
                  <tr>
                     <td><?= $datos->nit; ?></td>
                     <td><?= $datos->razon_social; ?></td>
                     <td><?= $datos->direccion; ?></td>
                     <td><?= $datos->telefono_fijo; ?></td>
                     <td><?= $datos->representante_legal; ?></td>
                     <td><?= $datos->nombre_contacto; ?></td>
                     <td><?= $datos->telefono_contacto; ?></td>
                     <td><?= $datos->tipo_empresa; ?></td>
                     <td><?= $datos->fecha_registro; ?></td>
                     <td>
                        <a href="#" onClick="editar(<?=$datos->id?>);" class="btn btn-info btn-xs btn-sm col mb-1">
                           Editar
                        </a>
                        <a href="#" class="btn btn-danger btn-xs btn-sm col" onClick="eliminar(<?=$datos->id?>);">
                           Eliminar
                        </a>
                     </td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/footable/footable.js"></script>
<script src="<?=PROOT?>js/footable/footableConfig.js"></script>
<script>
   $('.custom-file-input').on('change', function() { 
      let fileName = $(this).val().split('\\').pop(); 
      $(this).next('.custom-file-label').addClass("selected").html(fileName); 
   });
   function nuevo(){  
      jQuery.ajax({
         url : '<?=PROOT?>empresas/nuevo',
         method : "GET",
         success : function(resp){
            jQuery('#bodyModal').html(resp);
            jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
            jQuery('#frmModal').modal('show');
         }
      }); 
   }

   function editar(id){ 
      jQuery.ajax({
         url : '<?=PROOT?>empresas/editar',
         data:{id:id},
         method : "GET",
         success : function(resp){
            jQuery('#bodyModal').html(resp);
            jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
            jQuery('#frmModal').modal('show');
         }
      });
   }

   function guardar(){
      if($("#frmEmpresas").valid()){
         var form = new FormData($('#frmEmpresas')[0]);
         if (document.getElementById("logo").files.length == 0 ) { //if the file is empty
               form.delete('logo'); //remove it from the upload data
         }
         console.log(form);return;
         //var form = jQuery('#frmEmpresas').serialize();
         jQuery.ajax({
            url : '<?=PROOT?>empresas/nuevo',
            method: "POST",
            data : form,
            contentType: false,
            cache: false,
            processData:false,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
                  setTimeout(function () {
                         window.location.href = '<?=PROOT?>empresas'; //will redirect to your blog page (an ex: blog.html)
                      }, 1500);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
                  return;
               }
            }
         });
      }
   }

   function actualizar(){
      if($("#frmEmpresas").valid()){
         //var form = jQuery('#frmEmpresas').serialize();
         
         var form = new FormData($('#frmEmpresas')[0]);
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
                         window.location.href = '<?=PROOT?>empresas'; //will redirect to your blog page (an ex: blog.html)
                      }, 1500);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
                  return;
               }
            }
         });
      }
   }

   function eliminar(id){
      swal({
         title: "Eliminar regisrtro",
         text: "¿Esta usted seguro de eliminar este registro?",
         type: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Aceptar',
         cancelButtonText: 'Cancelar',
         confirmButtonColor: '#d33',
      },
      function(isConfirm) {
         if (isConfirm) {
            jQuery.ajax({
               url : '<?=PROOT?>empresas/eliminar',
               method: "POST",
               data : {id:id},
               success: function(resp){
                  if(resp.success){
                     window.location.href = '<?=PROOT?>empresas'; //will redirect to your blog page (an ex: blog.html)
                  }else{
                     alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
                     return;
                  }
               }
            });
         }
      });
   }
      
   jQuery('#frmModal').on('show.bs.modal', function(){
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
   });
</script>
<?php $this->end(); ?>