<?php $this->setSiteTitle('Listado de tipos de productos')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/footable/footable.standalone.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-info">
   <div class="card-header text-center bg-success text-white">
      Listado de tipos de productos
   </div>
   <div class="card-body pt-2">
      <a href="#" onClick="nuevo();" class="btn btn-info btn-md float-right mb-2">Nuevo registro</a>
      <div class="table-responsive">
         <table class="table table-striped table-condensed table-bordered table-hover">
            <thead class="text-center">
               <th class="col-auto bg-success">Tipo de producto</th>
               <th class="col-auto bg-success">Acciones</th>
            </thead>
            <tbody>
               <?php foreach($this->datos as $datos): ?>
                  <tr>
                     <td><?= $datos->tipo_producto; ?></td>
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
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/footable/footable.js"></script>
<script src="<?=PROOT?>js/footable/footableConfig.js"></script>
<script>
   function nuevo(){  
      jQuery.ajax({
         url : '<?=PROOT?>tipoProducto/nuevo',
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
         url : '<?=PROOT?>tipoProducto/editar',
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
      if($("#frmTipoProducto").valid()){
         var form = jQuery('#frmTipoProducto').serialize();
         jQuery.ajax({
            url : '<?=PROOT?>tipoProducto/nuevo',
            method: "POST",
            data : form,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
                  setTimeout(function () {
                         window.location.href = '<?=PROOT?>tipoProducto'; //will redirect to your blog page (an ex: blog.html)
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
      if($("#frmTipoProducto").valid()){
         var form = jQuery('#frmTipoProducto').serialize();
         jQuery.ajax({
            url : '<?=PROOT?>tipoProducto/editar',
            method: "POST",
            data : form,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido actualizado con exito', 'success',2000);
                  setTimeout(function () {
                         window.location.href = '<?=PROOT?>tipoProducto'; //will redirect to your blog page (an ex: blog.html)
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
               url : '<?=PROOT?>tipoProducto/eliminar',
               method: "POST",
               data : {id:id},
               success: function(resp){
                  if(resp.success){
                     window.location.href = '<?=PROOT?>tipoProducto'; //will redirect to your blog page (an ex: blog.html)
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
      $("#frmTipoProducto").validate({
         lang: 'es',
         rules: {
            tipo_producto: {
               required: true
            }
         },
         messages: {
            tipo_producto: {
               required:"El tipo de producto{} es requerido."
            }
         }
      });
   });
</script>
<?php $this->end(); ?>