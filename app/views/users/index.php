<?php $this->setSiteTitle('Listado de usuarios')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-primary">
   <div class="card-header text-center blue-bg text-white">
      <h3>Listado de usuario</h3>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table id="tabla" class="table table-striped table-condensed table-bordered table-hover">
            <thead class="blue-bg text-center">
               <th class="col-auto blue-bg"></th>
               <th class="col-auto blue-bg">Documento</th>
               <th class="col-auto blue-bg">Nombre completo</th>
               <th class="col-auto blue-bg">Correo eletrónico</th>
               <th class="col-auto blue-bg">Teléfono fijo</th>
               <th class="col-auto blue-bg">Celular</th>
               <th class="col-auto blue-bg">Acciones</th>
            </thead>
            <tbody class="">
               <?php //foreach($this->datos as $datos): ?>
                  
               <?php //endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php $this->partial('users','form_habilitar');?>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?=PROOT?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script>
   $(document).ready(function () {
      cargarGrilla();
   });

   function cargarGrilla(){
      var data='<?php echo json_encode($this->datos);?>';
      //console.log(data);
      data=JSON.parse(data);
      console.log(data);
      var table=$('#tabla').DataTable({
         destroy: true,
         "data":data,
         "responsive":true,
         "language": {
            "lengthMenu": "Mostrando _MENU_ elementos por página",
            "processing": "Procesando...",
            "zeroRecords": "No se encontraron registros",
            "search": "Buscar",
            "infoEmpty": "No se encontraron registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "info":"Mostrando registros del _START_ al _END_ para un total de: _TOTAL_ registros.",

            "paginate": {
               "first":    "Primero",
               "last":     "Último",
               "next":     "Siguiente",
               "previous": "Anterior"
            },
         },
         "columns":[
         {
            "className":      'details-control',
            "orderable":      false,
            "data":           null,
            "title":'Más info',
            "defaultContent": ''
         },
         {"data":"documento"},
         {"data":"nombre"},
         {"data":"correo"},
         {"data":"telefono_fijo"},
         {"data":"celular"},
         {"data":"user_id"}
         ],

         "columnDefs": 
         [ 
            {
               "targets": 6,
               "data": null,
               "render": function (data, type, row) {
                  if(row.estado==1)
                     return `
                        <button class="btn btn-primary btn-xs btn-sm col-auto" tittle="Habilitar"  onClick="habilitarUsuario(${row.user_id});">Cambiar rol</button>
                        <button class="btn btn-danger btn-xs btn-sm col-auto" tittle="Inhabilitar"  onClick="inhabilitarUsuario(${row.user_id});">Inhabiltar</button>
                        `
                  else
                     return `
                        <button class="btn btn-success btn-xs btn-sm col-auto" tittle="Habilitar"  onClick="habilitarUsuario(${row.user_id});">Habilitar usuario</button>
                        `
               }  
            },
            {
               "targets": 1,
               "data": "nombre",
               "render": function ( data, type, row ) {
                  return row.nombre+' '+row.apellido ;
               }
            }
         ]
      });
      $('#tabla tbody').on('click', 'td.details-control', function () {
         var tr = $(this).closest('tr');
         var row = table.row( tr );
    
         if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
         }
         else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
         }
      });
   }

   function format ( d ) {
      // `d` is the original data object for the row
      if(d.empresa_id!=null)
         return '<div class="col-md-12 text-left blue-bg rounded"><p>Empresa: '+d.razon_social+'</p>'+
            '<p>Dirección: '+d.direccion+'</p>'+
            '<p>Teléfono: '+d.telefono_fijo+'</p>'+
            '<p>Rol: '+d.rol+'</p></div>'
         ;
      else
         return '<div class="col-md-12 text-left blue-bg rounded"><p>Rol: '+d.rol+'</p></div>';
   }

   function habilitarUsuario(id){ 
      jQuery.ajax({
         url : '<?=PROOT?>users/buscarPorId',
         method : "POST",
         data : {id},
         success : function(resp){
           if(resp.success){
             jQuery('#id').val(resp.datos.id);
             jQuery('#nombre').val(resp.datos.nombre);
             jQuery('#correo').val(resp.datos.correo);
             jQuery('#modalHabilitar').modal({backdrop: 'static', keyboard: false});
             jQuery('#modalHabilitar').modal('show');
           } else {
             jQuery('#id').val('');
             jQuery('#nombre').val('');
             jQuery('#correo').val('');
           }
         }
      });
   }

   function guardar(){
      var form = jQuery('#frmHabilitar').serialize();
      jQuery.ajax({
         url : '<?=PROOT?>users/habilitarUsuario',
         method: "POST",
         data : form,
         success: function(resp){
            if(resp.success){
               alertMsg('Proceso exitoso!','El usuario ha sido habilitado con exito', 'success',2000);
               jQuery('#modalHabilitar').modal('hide');
               setTimeout(function () {
                      window.location.href = '<?=PROOT?>users/index'; //will redirect to your blog page (an ex: blog.html)
                   }, 1500);
            }else{
               alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
               return;
            }
         }
      });
   }

   function inhabilitarUsuario(id){

      //var form = jQuery('#frmHabilitar').serialize();
      jQuery.ajax({
         url : '<?=PROOT?>users/inhabilitarUsuario',
         method: "POST",
         data : {id:id},
         success: function(resp){
            if(resp.success){
               alertMsg('Proceso exitoso!','El usuario ha sido habilitado con exito', 'success',2000);
               setTimeout(function () {
                      window.location.href = '<?=PROOT?>users/index'; //will redirect to your blog page (an ex: blog.html)
                   }, 1500);
            }else{
               console.log(resp.errors);
               alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
               return;
            }
         }
      });
   }

   jQuery('#modalHabilitar').on('hidden.bs.modal',function(){
      var frmHabilitar = $( "#frmHabilitar" );
      frmHabilitar.validate().resetForm();
      frmHabilitar.find('.error').removeClass('error');
   });

   jQuery('#modalHabilitar').on('show.bs.modal', function(){
      $("#frmHabilitar").validate({
         lang: 'es',
         rules: {
            rol_id: {
               required: true,
            }
         },
         messages: {
            rol_id: {
               required:"El rol es requerido."
            }
         }
      });
   });
</script>
<?php $this->end(); ?>