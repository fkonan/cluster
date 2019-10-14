<?php $this->setSiteTitle('Documentos Adjuntos')?>
<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/footable/footable.standalone.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body');?>
<div class="row">
   <div class="col-md-12">
      <div class="ibox bg-white">
         <div class="ibox-title <?=$this->color?> rounded-top">
            <h5>LISTADO DE DOCUMENTOS ADJUNTOS</h5>
         </div>

         <a href="#" onClick="nuevo();" class="btn btn-success btn-md float-right mx-2 my-1">Nuevo registro</a>

         <div class="ibox-content px-2">
            <div class="table-responsive">
               
               <table class="table table-striped table-condensed table-bordered table-hover" data-filter=#filter>
                  <thead class="text-center">
                     <th class="col-auto <?=$this->color?>">Título</th>
                     <th class="col-auto <?=$this->color?>">Descripción</th>
                     <th class="col-auto <?=$this->color?>">Autor</th>
                     <th class="col-auto <?=$this->color?>" data-filterable="false">Acciones</th>
                  </thead>
                  <tbody>
                     <?php foreach($this->datos as $datos): ?>
                        <tr>
                           <td><?= $datos->titulo; ?></a></td>
                           <td><?= $datos->descripcion; ?></a></td>
                           <td><?= $datos->autor; ?></a></td>
                           <td>
                              <a href="#" onClick="editar(<?=$datos->id?>);" class="btn btn-info btn-xs btn-sm">
                                 Editar
                              </a>
                              <a href="#" class="btn btn-danger btn-xs btn-sm" onClick="eliminar(<?=$datos->id?>);">
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
   </div> 
</div>

<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/footable/footable.js"></script>
<script src="<?=PROOT?>js/footable/footableConfig.js"></script>
<script>
   function nuevo(){  
      jQuery.ajax({
         url : '<?=PROOT?>adjuntos/aguaNuevo',
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
         url : '<?=PROOT?>adjuntos/editar',
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
      if($("#frmAdjuntos").valid()){
         //var form = jQuery('#frmAjuntos').serialize();
         var form= new FormData(jQuery('#frmAdjuntos')[0]);
         
         jQuery.ajax({
            url : '<?=PROOT?>adjuntos/aguaNuevo',
            method: "POST",
            data : form,
            contentType: false,
            cache: false,
            processData:false,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
                  setTimeout(function () {
                     window.location.href = '<?=PROOT?>adjuntos/agua'; //will redirect to your blog page (an ex: blog.html)
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
      if($("#frmAdjuntos").valid()){
         //var form = jQuery('#frmAjuntos').serialize();
         var form= new FormData(jQuery('#frmAdjuntos')[0]);
         
         jQuery.ajax({
            url : '<?=PROOT?>adjuntos/editar',
            method: "POST",
            data : form,
            contentType: false,
            cache: false,
            processData:false,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
                  setTimeout(function () {
                     window.location.href = '<?=PROOT?>adjuntos/agua'; //will redirect to your blog page (an ex: blog.html)
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
               url : '<?=PROOT?>adjuntos/eliminar',
               method: "POST",
               data : {id:id},
               success: function(resp){
                  if(resp.success){
                     window.location.href = '<?=PROOT?>adjuntos';
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
      $("#frmAdjuntos").validate({

         lang: 'es',
         rules: {
            titulo: {
               required: true
            },
            descripcion: {
               required: true
            },
            autor: {
               required: true
            },
            adjunto: {
               required: true
            }
         },
         messages: {
            titulo: {
               required:"El Título es requerido."
            },
            descripcion: {
               required:"La descripción es requerido."
            },
            autor: {
               required:"El autor es requerido."
            },
            adjunto: {
               required:"El adjunto es requerido."
            }
         }
      });
   });
</script>
<?php $this->end(); ?>