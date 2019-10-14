<?php $this->setSiteTitle('Listado de tipos de Oferta Académica')?>
<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="card border-info">
	<div class="card-header text-center bg-success text-white">
		<strong>Listado de tipos de oferta académica</strong>
	</div>
	<div class="card-body pt-2">
		<a href="#" class="btn btn-info btn-md float-right mb-2" onClick="agregarNuevoTipoOferta();">Nuevo registro</a>
		<div class="table-responsive">
			<table id="tblTiposOfertaAcademica" class="table table-striped table-condensed table-bordered table-hover">
				<thead class="blue-bg text-center">
					<th class="col-auto blue-bg">id</th>
					<th class="col-auto blue-bg">Nombre Tipo De Oferta Académica</th>
					<th class="col-auto blue-bg">Mantenimiento</th>
				</thead>
				<tbody class="">
					<?php 

					foreach($this->datos as $datos){

			//True = tiene registros asociados
						if($datos->Eliminable=='true'){
							$htmlEliminable = '<a href="#" onclick="eliminarTOA('.$datos->id.', false)" class="btn btn-secondary">Eliminar</a>';
						}else{
							$htmlEliminable = '<a href="#" onclick="eliminarTOA('.$datos->id.', true)" class="btn btn-primary">Eliminar</a>';
						}

						echo '<tr>
						<td align="center">'.$datos->id.'</td>
						<td align="center">'.$datos->nom.'</td>
						<td align="center">
						<a href="#" onclick="agregarNuevoTipoOferta('.$datos->id.', \''.$datos->nom.'\')" class="btn btn-primary">Modificar</a>
						'.$htmlEliminable.'
						</td>
						</tr>';
					}

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?=PROOT?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script>
	
	$(document).ready(function () {
		$('#tblTiposOfertaAcademica').DataTable({
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
		});
	});
	
	function guardarTOA(){
		
		//alert('Guardando nueva TOA');
		if($('#txt_nomTOA').val() == ''){
			alertMsg('Datos Incompletos','Debe digital un nombre para la Oferta Académica', 'error',2000);
			$('#txt_nomTOA').focus();
			return false;
		}else{
			var form = jQuery('#frmNuevaOA').serialize();
			jQuery.ajax({
			url : '<?=PROOT?>tipoOfertaAcademica/guardar',
			method: "POST",
			data : form,
			success: function(resp){
				//console.log(resp);
				console.log(resp.errors);
				if(resp.success){
				  alertMsg('Proceso exitoso!','El registro ha sido creado con exito', 'success',2000);
				  setTimeout(function () {
						 window.location.href = '<?=PROOT?>tipoOfertaAcademica'; //will redirect to your blog page (an ex: blog.html)
					  }, 1500);
				}else{
				  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
				  return;
				}
			}
			});
			
		}

	}
	
	function eliminarTOA(idTOA, eliminable){
		//eliminarTOA eliminarTOAAction($idTOA="")
		//alert(eliminable);
		if(eliminable){
			// Si llega TRUE = Es eliminable
		   	//alert('Eliminando TOA id: ' + idTOA);
			
			jQuery.ajax({
			url : '<?=PROOT?>tipoOfertaAcademica/eliminarTOA',
			method: "POST",
			data:{idTOA:idTOA},
			success: function(resp){
				//console.log(resp);
				console.log(resp);
				if(resp.success){
				  alertMsg('Proceso exitoso!','El registro ha sido eliminado con exito', 'success',2000);
				  setTimeout(function () {
						 window.location.href = '<?=PROOT?>tipoOfertaAcademica'; //will redirect to your blog page (an ex: blog.html)
					  }, 1500);
				}else{
				  alertMsg('Proceso fallido!','El registro no pudo ser eliminado: '+resp.errors, 'error',2000);
				  return;
				}
			}
			});

		}else{
			//Si llega false = no es eliminable
			//alert('Tiene registros asociados id: ' + idTOA);
			alertMsg('Proceso fallido!','El registro que intenta eliminar tiene registros asiciados con Ofertas Académicas: ', 'error',2000);
			return false;
		}
		
	}

	// Muestra modal para agregar y para modificar un TOA0
	function agregarNuevoTipoOferta(idTOA='', nomTOA=''){
	  //alert('Agregando nuevo');
	   // Envia al controlador roles
	  jQuery.ajax({
		 url : '<?=PROOT?>tipoOfertaAcademica/nuevo',
		 method : "GET",
		 data:{
			 	idTOA:idTOA, 
			 	nomTOA:nomTOA
			  },
		 success : function(resp){
			//console.log(resp);
			jQuery('#modalTitulo').html('Tipo de Oferta Académica');
			jQuery('#bodyModal').html(resp);
			jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
			jQuery('#frmModal').modal('show');
		 }
	  });
	}

	
	function modificarTOA(idTOA){
		//alert('Modificando TOA id: ' + idTOA + ' / nomTOA: ' + nomTOA);
		nomTOA = jQuery('#txt_nomTOA').val();
		   
		jQuery.ajax({
		url : '<?=PROOT?>tipoOfertaAcademica/editar',
		data:{
			 	idTOA:idTOA, 
			 	nomTOA:nomTOA
			  },
		method : "GET",
		success : function(resp){
			
				//console.log(resp);
				if(resp.success){
				   alertMsg('Proceso exitoso!','El registro se actualizó con exito', 'success',2000);
				   jQuery('#frmModal').modal('hide');
				   setTimeout(function () {
						  window.location.href = '<?=PROOT?>tipoOfertaAcademica'; //will redirect to your blog page (an ex: blog.html)
					   }, 1500);
				}else{
				   alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
				   return;
				}
			
			}
			
		});
		
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

</script>
<?php $this->end(); ?>