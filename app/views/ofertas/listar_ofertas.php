<?php
use Core\FH;
use Core\H;
?>
<?php $this->setSiteTitle('Listado de Ofertas')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/footable/footable.standalone.css" rel="stylesheet">
<link href="<?=PROOT?>css/plugins/pagination/pagination.min.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-info mb-2">
   <div class="card-header text-center bg-primary text-white">
      <h3>Listado de Ofertas</h3>
   </div>
   <div class="card-body pt-2">
      
     <form method="post" action="" id="frmBuscarOA" name="frmBuscarOA" role="form" >         
        <div class="row p-2 justify-content-center">
         <p>&nbsp;</p>
         <p class="justify-content-center">
            <div class="form-check-inline">
               <a href="#" onClick="functionCheck('PRODUCTOS');" style="text-decoration: none; color: black;">
                  <input type="radio" class="form-check-input" id="rd_productos" name="optradio" value="Productos" onclick="mostrarFiltros('PRO')" checked><strong>PRODUCTOS</strong>
               </a>
            </div>
            <div class="form-check-inline">
               <a href="#" onClick="functionCheck('OA');" style="text-decoration: none; color: black;">
                  <input type="radio" class="form-check-input" id="rd_academicos" name="optradio" value="OfertaAcademica" onclick="mostrarFiltros('OA')"><strong>OFERTA ACADÉMICA</strong>
               </a>
            </div>
         </p>
         <p>&nbsp;</p>
        </div>
        
         <div id="filtrosBusquedaProducto" class="row gray-bg mb-2 py-2 justify-content-center">
                  
            <?= FH::inputBlock('text','Nombre de la empresa:','txt_razon_social','',['class'=>'form-control','id'=>'txt_razon_social'],['class'=>'form-group col-md-4'],[]) ?>

            <?= FH::selectBlock('Seleccione el sector','cmb_sector_id','',$this->sectores,['class'=>'form-control','id'=>'cmb_sector_id', 'placeHolder'=>'seleccione'],['class'=>'col-md-4'],[]) ?>

            <?= FH::selectBlock('Seleccione el modulo','cmb_modulo_id','',$this->modulos,['class'=>'form-control','id'=>'cmb_modulo_id' ,'placeHolder'=>'seleccione'],['class'=>'col-md-3'],[]) ?>
            
            <div class="col-md-1 px-0">
               <button type="button" class="btn btn-success mt-4" onClick="buscarProductos();return;">Buscar</button>
            </div>
         </div>

         <div id="filtrosBusquedaOAcademica" class="row gray-bg mb-2 justify-content-center" style="display: none;">
            
          <?= FH::inputBlock('text','Nombre de la Oferta:','txt_nomOA','',['class'=>'form-control','id'=>'txt_nomOA'],['class'=>'form-group col-md-4'],[]) ?>
          
            <?= FH::selectBlock('Seleccione Institución:','cmb_empresa_id','',$this->empresas,['class'=>'form-control','id'=>'cmb_empresa_id', 'placeHolder'=>'seleccione'],['class'=>'col-md-4'],[]) ?>

            <?= FH::selectBlock('Seleccione Tipo de Oferta','cmb_tipo_oferta','',$this->tipoOfertaAcademica,['class'=>'form-control','id'=>'cmb_tipo_oferta' ,'placeHolder'=>'seleccione'],['class'=>'col-md-3'],[]) ?>

            <div class="col-md-1 px-0">
               <button id="btn_buscar" name="btn_buscar" type="button" class="btn btn-success mt-4" onClick="bucarOfertaAcademica();return;">Buscar</button>
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
      buscarProductos();
   });
   
   function functionCheck(opt){
      
      if(opt=='PRODUCTOS'){
         //alert('PRODUCTOS');
         $('#filtrosBusquedaOAcademica').hide();
         $('#filtrosBusquedaProducto').slideDown(500);
         $('#data-container').html('');
         $('#pagination-container').html('');
         $("#rd_academicos").prop('checked', false);
         $("#rd_productos").prop('checked', true);
         buscarProductos();
      }else{
         //alert('OA');
         $('#filtrosBusquedaProducto').hide();
         $('#filtrosBusquedaOAcademica').slideDown(500);
         $('#data-container').html('');
         $('#pagination-container').html('');
         $("#rd_academicos").prop('checked', true);
         $("#rd_productos").prop('checked', false);
         bucarOfertaAcademica();
      }
      
   }

   function bucarOfertaAcademica(){
     //alert('Buscando OA');
     var form = jQuery('#frmBuscarOA').serialize();
     jQuery.ajax({
       url : '<?=PROOT?>OfertaAcademica/buscar',
       method : 'POST',
       data:form,
       success : function(resp){
         //console.log(resp);
         $('#pagination-container').pagination({
            dataSource: resp.datos,
            pageSize: 12,
            locator: 'items',
            callback: function(data, pagination) {
              //console.log(data);
              var dataHtml = '<div class="row">';
              $.each(data, function (index, item) {

                var pagina_web='';
                var email='';
                var adjunto='';

                if(item.pagina_web!=null)
                  pagina_web=item.pagina_web;

                if(item.correo_contacto!=null)
                  email=item.correo_contacto;

                if(item.adjunto!=null)
                  adjunto='<?php echo PROOT?>'+item.adjunto;
                  adjunto=item.adjunto;

                dataHtml +='<div class="col-lg-4">';
                dataHtml +='<div class="contact-box center-version p-2">';
                dataHtml +='<div class="text-center">';
                dataHtml +='<img alt="logo" class="img-thumbnail img-fluid" src="<?php echo PROOT?>'+item.logo+'">';
                dataHtml +='</div>';
                dataHtml +='<h3 class="m-b-xs text-center"><strong>'+item.razon_social+'</strong></h3>';
                dataHtml +='<hr>';
                dataHtml +='<address>';
                dataHtml +='<strong>Oferta: </strong> '+item.nombre_oa.toUpperCase() +'<br>';
                dataHtml +='<strong>Tipo: </strong> '+item.nombre_toa.toUpperCase()+'<br>';
                dataHtml +='<strong>Duracion: </strong> '+item.duracion+'<br>';
                dataHtml +='<strong>Persona de contacto:</strong> '+item.nombre_contacto+'<br>';
                dataHtml +='<strong>Teléfono de contacto:</strong> '+item.telefono_contacto+'<br>';
                dataHtml +='</address>';
                dataHtml +='<div class="contact-box-footer">';
                dataHtml +='<div class="m-t-xs btn-group">';
                dataHtml +='<a href="'+pagina_web+'" class="btn btn-xs btn-success"><i class="fa fa-globe"></i> Pagina Web</a>';
                dataHtml +='<a href=mailto:"'+email+'"  class="btn btn-xs btn-warning"><i class="fa fa-envelope"></i> Email</a>';
                dataHtml +='<a href="'+adjunto+'" class="btn btn-xs btn-info"><i class="fa fa-download"></i> Más información</a>';
                dataHtml +='<a href="#" onClick="meInteresaOA('+item.oa_id+');return;" class="btn btn-xs btn-primary"><i class="fa fa-download"></i> Más información</a>';
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

   function meInteresaOA(OA_id){  
     jQuery.ajax({
       url : '<?=PROOT?>ofertaAcademica/nuevo',
       method : "GET",
       data : {OA_id:OA_id},
       success : function(resp){
         jQuery('#modalTitulo').html('Contactar con Universidad');
         jQuery('#bodyModal').html(resp);
         jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
         jQuery('#frmModal').modal('show');
       }
     });
   }  
   
   function buscarProductos() {
     //alert('Buscando productos');
     var form = jQuery('#frmBuscarOA').serialize();
     jQuery.ajax({
       url : '<?=PROOT?>ofertas/buscar',
       method : 'POST',
       data:form,
       success : function(resp){
         //console.log(resp.rs);
         $('#pagination-container').pagination({
            dataSource: resp.datos,
            pageSize: 12,
            locator: 'items',
            callback: function(data, pagination) {
              var dataHtml = '<div class="row">';
              $.each(data, function (index, item) {

                var pagina_web='';
                var email='';
                var adjunto='';

                if(item.pagina_web!=null)
                  pagina_web=item.pagina_web;

                if(item.correo_contacto!=null)
                  email=item.correo_contacto;

                if(item.adjunto!=null)
                  adjunto=item.adjunto;

                dataHtml +='<div class="col-lg-4">';
                dataHtml +='<div class="contact-box center-version p-2">';
                dataHtml +='<div class="text-center">';
                dataHtml +='<img alt="logo" class="img-thumbnail img-fluid" src="<?php echo PROOT?>'+item.logo+'">';
                dataHtml +='</div>';
                dataHtml +='<h3 class="m-b-xs text-center"><strong>'+item.razon_social+'</strong></h3>';
                dataHtml +='<div class="font-bold text-center">Sector: '+item.sector+'</div>';
                dataHtml +='<hr>';
                dataHtml +='<address>';
                dataHtml +='<strong>Producto:</strong> '+item.producto+'<br>';
                dataHtml +='<strong>Dirección:</strong> '+item.direccion+'<br>';
                dataHtml +='<strong>Teléfono de la empresa:</strong> '+item.telefono_fijo+'<br>';
                dataHtml +='<strong>Persona de contacto:</strong> '+item.nombre_contacto+'<br>';
                dataHtml +='<strong>Teléfono de contacto:</strong> '+item.telefono_contacto+'<br>';
                dataHtml +='</address>';
                dataHtml +='<div class="contact-box-footer">';
                dataHtml +='<div class="m-t-xs btn-group">';
                dataHtml +='<a href="'+pagina_web+'" class="btn btn-xs btn-success"><i class="fa fa-globe"></i> Pagina Web</a>';
                dataHtml +=' <a href=mailto:"'+email+'"  class="btn btn-xs btn-warning"><i class="fa fa-envelope"></i> Email</a>';
                dataHtml +='<a href="'+adjunto+'"  class="btn btn-xs btn-info"><i class="fa fa-download"></i> Más información</a>';
                dataHtml +='</div>';
                dataHtml +='<div class="m-t-xs btn-group">';
                dataHtml +='<button type="button" class="btn btn-primary mt-4" onClick="meInteresaProducto('+item.productos_id+');return;">Me interesa...</button>';

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

   function meInteresaProducto(producto_id){  
     jQuery.ajax({
       url : '<?=PROOT?>ofertas/nuevo',
       method : "GET",
       data : {producto_id:producto_id},
       success : function(resp){
         jQuery('#modalTitulo').html('Contactar con proveedor');
         jQuery('#bodyModal').html(resp);
         jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
         jQuery('#frmModal').modal('show');
       }
     });
   }
   
   function guardarSolicitudOA(){
     if($("#frmOAcademicas").valid()){
       var form = jQuery('#frmOAcademicas').serialize();
       jQuery.ajax({
         url : '<?=PROOT?>OfertaAcademica/guardarSolicitudOA',
         method: "POST",
         data : form,
         success: function(resp){
         //console.log(resp);
            if(resp.success){
              alertMsg('Proceso exitoso!','Su solicitud ha siddo enviada a la universidad, pronto se pondran en contacto contigo.', 'success',2500);
              setTimeout(function () {
                   window.location.href = '<?=PROOT?>ofertas/listarOfertas'; //will redirect to your blog page (an ex: blog.html)
                 }, 1500);
            }else{
              alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
              return;
            }
         }
       });
     }
   }
   
   function guardar(){
     if($("#frmOfertas").valid()){
       var form = jQuery('#frmOfertas').serialize();
       jQuery.ajax({
         url : '<?=PROOT?>ofertas/nuevo',
         method: "POST",
         data : form,
         success: function(resp){
            if(resp.success){
              alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
              setTimeout(function () {
                   window.location.href = '<?=PROOT?>ofertas/listarOfertas'; //will redirect to your blog page (an ex: blog.html)
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
     $("#frmOfertas").validate({
       lang: 'es',
       rules: {
         descripcion: {
            required: true
         }
       },
       messages: {
         descripcion: {
            required:"La descripción es requerida."
         }
       }
     });
   });
</script>
<?php $this->end(); ?>