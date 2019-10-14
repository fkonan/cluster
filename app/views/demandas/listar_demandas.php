<?php
use Core\FH;
use Core\H;
?>
<?php $this->setSiteTitle('Listado de Demandas')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/footable/footable.standalone.css" rel="stylesheet">
<link href="<?=PROOT?>css/plugins/pagination/pagination.min.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-info mb-2">
   <div class="card-header text-center bg-primary text-white">
      <h3>Listado de Demandas</h3>
   </div>
   <div class="card-body pt-2">
      <form method="post" action="" id="frmBuscar" role="form">
         <div class="row gray-bg mb-2">
            <div class="col-md-12 mt-2">
               <h3>A continuación haga una busqueda de acuerdo a su preferencia:</h3>
            </div>
            <?= FH::inputBlock('text','Nombre de la empresa','razon_social','',['class'=>'form-control'],['class'=>'form-group col-md-4'],[]) ?>

            <?= FH::selectBlock('Seleccione el sector','sector_id','',$this->sectores,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-4'],[]) ?>

            <div class="col-md-1 px-0">
               <button type="button" class="btn btn-success mt-4" onClick="buscar();return;">Buscar</button>
               
            </div>
            <div class="col-md-1 px-0">
               <button type="button" class="btn btn-info mt-4" onClick="nuevo();return;">Nueva demanda</button>
            </div>
         </div>
      </form>
      <div class="row">
         <div class="col-md-12">
         <div id="data-container"></div>
         </div>
      </div>     
      <div class="row">
         <div class="col-md-12">
            <div id="pagination-container"></div>
         </div>
      </div>
   </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/footable/footable.js"></script>
<script src="<?=PROOT?>js/plugins/pagination/pagination.min.js"></script>
<script src="<?=PROOT?>js/footable/footableConfig.js"></script>
<script>
   $( document ).ready(function() {
        cargar();
   });

   function cargar() {
      jQuery.ajax({
         url : '<?=PROOT?>demandas/buscar',
         method : "GET",
         success : function(resp){
            console.log(resp);
            $('#pagination-container').pagination({
               dataSource: resp.datos,
               pageSize: 12,
               locator: 'items',
               callback: function(data, pagination) {

                  var dataHtml = '<div class="row">';
                  $.each(data, function (index, item) {

                     var pagina_web='';
                     var email='';

                     if(item.pagina_web!=null)
                        pagina_web='http://'+item.pagina_web;
                     
                     if(item.correo_contacto!=null)
                        email=item.correo_contacto;

                     dataHtml +='<div class="col-lg-4">';
                     dataHtml +='<div class="contact-box center-version p-2">';
                     dataHtml +='<div class="text-center">';
                     dataHtml +='<img alt="logo" class="img-thumbnail img-fluid" src="<?php echo PROOT?>'+item.logo+'">';
                     dataHtml +='</div>';
                     dataHtml +='<h3 class="m-b-xs text-center"><strong>'+item.razon_social+'</strong></h3>';
                     dataHtml +='<div class="font-bold text-center">Sector: '+item.sector+'</div>';
                     dataHtml +='<hr>';
                     dataHtml +='<address>';
                     dataHtml +='<strong>Solicitud:</strong> '+item.descripcion+'<br>';
                     dataHtml +='<strong>Dirección:</strong> '+item.direccion+'<br>';
                     dataHtml +='<strong>Teléfono de la empresa:</strong> '+item.telefono_fijo+'<br>';
                     dataHtml +='<strong>Persona de contacto:</strong> '+item.nombre_contacto+'<br>';
                     dataHtml +='<strong>Teléfono de contacto:</strong> '+item.telefono_contacto+'<br>';
                     dataHtml +='</address>';
                     dataHtml +='<div class="contact-box-footer">';
                     dataHtml +='<div class="m-t-xs btn-group">';
                     dataHtml +='<a href="'+pagina_web+'" target="_blank" class="btn btn-xs btn-success"><i class="fa fa-globe"></i> Pagina Web</a>';
                     dataHtml +=' <a href="mailto:'+email+'"  class="btn btn-xs btn-warning"><i class="fa fa-envelope"></i> Email</a>';
                     dataHtml +='</div>';
                     dataHtml +='<div class="my-1">';
                     dataHtml +='<button type="button" class="btn btn-primary mt-1" onClick="responder('+item.demanda_id+');return;">Responder solicitud</button>';

                     dataHtml +='</div>';
                     dataHtml +='</div>';
                     dataHtml +='</div>';
                     dataHtml += '</div>';
                  });
                  dataHtml += '</div>';
                  $('#data-container').html(dataHtml);
               }
            }); 
         }
      });
   }

   function buscar() {
      var form = jQuery('#frmBuscar').serialize();
      jQuery.ajax({
         url : '<?=PROOT?>demandas/buscar',
         method : "POST",
         data:form,
         success : function(resp){
            $('#pagination-container').pagination({
               dataSource: resp.datos,
               pageSize: 12,
               locator: 'items',
               callback: function(data, pagination) {
                  var dataHtml = '<div class="row">';
                  $.each(data, function (index, item) {

                     var pagina_web='';
                     var email='';

                     if(item.pagina_web!=null)
                        pagina_web=item.pagina_web;
                     
                     if(item.correo_contacto!=null)
                        email=item.correo_contacto;


                     dataHtml +='<div class="col-lg-4">';
                     dataHtml +='<div class="contact-box center-version p-2">';
                     dataHtml +='<div class="text-center">';
                     dataHtml +='<img alt="logo" class="img-thumbnail img-fluid" src="<?php echo PROOT?>'+item.logo+'">';
                     dataHtml +='</div>';
                     dataHtml +='<h3 class="m-b-xs text-center"><strong>'+item.razon_social+'</strong></h3>';
                     dataHtml +='<div class="font-bold text-center">Sector: '+item.sector+'</div>';
                     dataHtml +='<hr>';
                     dataHtml +='<address>';
                     dataHtml +='<strong>Solicitud:</strong> '+item.descripcion+'<br>';
                     dataHtml +='<strong>Dirección:</strong> '+item.direccion+'<br>';
                     dataHtml +='<strong>Teléfono de la empresa:</strong> '+item.telefono_fijo+'<br>';
                     dataHtml +='<strong>Persona de contacto:</strong> '+item.nombre_contacto+'<br>';
                     dataHtml +='<strong>Teléfono de contacto:</strong> '+item.telefono_contacto+'<br>';
                     dataHtml +='</address>';
                     dataHtml +='<div class="contact-box-footer">';
                     dataHtml +='<div class="m-t-xs btn-group">';
                     dataHtml +='<a href="'+pagina_web+'" target="_blank" class="btn btn-xs btn-success"><i class="fa fa-globe"></i> Pagina Web</a>';
                     dataHtml +=' <a href="mailto:'+email+'"  class="btn btn-xs btn-warning"><i class="fa fa-envelope"></i> Email</a>';
                     dataHtml +='</div>';
                     dataHtml +='<div class="my-1">';
                     dataHtml +='<button type="button" class="btn btn-primary mt-1" onClick="responder('+item.demanda_id+');return;">Responder solicitud</button>';

                     dataHtml +='</div>';
                     dataHtml +='</div>';
                     dataHtml +='</div>';
                     dataHtml += '</div>';
                  });
                  dataHtml += '</div>';
                  $('#data-container').html(dataHtml);
               }
            }); 
         }
      });
   }

   function responder(demanda_id){  
      jQuery.ajax({
         url : '<?=PROOT?>demandas/responder',
         method : "GET",
         data : {demanda_id:demanda_id},
         success : function(resp){
            jQuery('#modalTitulo').html('Contactar al comprador');
            jQuery('#bodyModal').html(resp);
            jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
            jQuery('#frmModal').modal('show');
         }
      });
   }

   function nuevo(){  
      jQuery.ajax({
         url : '<?=PROOT?>demandas/nuevo',
         method : "GET",
         success : function(resp){
            jQuery('#modalTitulo').html('Crear nueva demanda');
            jQuery('#bodyModal').html(resp);
            jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
            jQuery('#frmModal').modal('show');
         }
      });
   }

   function guardar(){
      if($("#frmDemandas").valid()){
         var form = jQuery('#frmDemandas').serialize();
         jQuery.ajax({
            url : '<?=PROOT?>demandas/nuevo',
            method: "POST",
            data : form,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
                  setTimeout(function () {
                         window.location.href = '<?=PROOT?>demandas/listarDemandas'; //will redirect to your blog page (an ex: blog.html)
                      }, 1500);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
                  return;
               }
            }
         });
      }
   }

   function guardarRespuesta(){
      if($("#frmResponder").valid()){
         var form = jQuery('#frmResponder').serialize();
         jQuery.ajax({
            url : '<?=PROOT?>demandas/responder',
            method: "POST",
            data : form,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
                  setTimeout(function () {
                         window.location.href = '<?=PROOT?>demandas/listarDemandas'; //will redirect to your blog page (an ex: blog.html)
                      }, 1500);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
                  return;
               }
            }
         });
      }
   }

   jQuery('#frmModal').on('show.bs.modal', function(){
      $("#frmDemandas").validate({
         lang: 'es',
         rules: {
            respuesta: {
               required: true
            }
         },
         messages: {
            respuesta: {
               required:"La descripción es requerida."
            }
         }
      });
   });
</script>
<?php $this->end(); ?>