<?php $this->setSiteTitle('Listado de Ofertas Académicas')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<?php $this->end(); ?>

<?php 
		$this->start('body'); 

		/*		
		echo $this->currentUser."<br><br>";
		echo('<pre>');
		var_dump($this->datosTOA);
		echo('</pre><br><br>');

		echo('<pre>');
		var_dump($this->datosOA);
		echo('</pre>');
		*/
		
?>
<div class="card border-primary">
   <div class="card-header text-center blue-bg text-white">
      <h3>Listado de Ofertas Académicas</h3>
   </div>
   <div class="card-body">
      <div class="table-responsive">
		 <p align="">
		 	<a href="#" class="btn btn-primary" onClick="showModalAgregarModificarOA();">Agregar Nueva Oferta</a>
		 </p>
         <table id="tblOfertaAcademica" class="table table-striped table-condensed table-bordered table-hover">
            <thead class="blue-bg text-center">
				<th class="col-auto blue-bg">Nombre</th>
				<th class="col-auto blue-bg">Duración</th>
				<th class="col-auto blue-bg">Estado</th>
				<th class="col-auto blue-bg">Comentarios</th>
				<th class="col-auto blue-bg">Adjunto</th>
				<th class="col-auto blue-bg">Mantenimiento</th>
            </thead>
            <tbody class="">
               <?php 
					
					foreach($this->datosOA as $datosOA){
						
						if($datosOA->estado=='1'){
							$estado = 'Activo'; $actEstado = 'Desactivar';
						}else{
							$estado = 'Inactivo'; $actEstado = 'Activar';
						}
						
						$adjunto='<td align="center"><a href="#"><img src="'.PROOT.'img/pdf.png"></a></td>';
						
						if($datosOA->adjunto!='')
							$adjunto='<td align="center"><a href="#" onclick="mostrarAdjuntoEnModal(\'oferta_academica/'.$datosOA->adjunto.'\', \'ofertaAcademica\');"><img src="'.PROOT.'img/pdf.png"></a></td>';
						
						echo '<tr>
							 	<td align="center">'.$datosOA->ofertaNombre.'</td>
								<td align="center">'.$datosOA->duracion.'</td>
								<td align="center">'.$estado.'</td>
								<td align="center">'.$datosOA->comentarios.'</td>'
								.$adjunto.'
								
								<td align="center">
									<a href="#" onclick="showModalAgregarModificarOA('.$datosOA->id.')" class="btn btn-primary">Modificar</a>
									 | <a href="#" onclick="activarDesactivarOA('.$datosOA->id.')" class="btn btn-primary">'.$actEstado.'</a>
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
		$('#tblOfertaAcademica').DataTable({
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

	function activarDesactivarOA(idOA, newEstado){

		jQuery.ajax({
		 url : '<?=PROOT?>ofertaAcademica/cambiarEstadoOA',
		 method : "POST",
		 data: {
			idOA:idOA 
		 },
		 success : function(resp){

			//console.log(resp.success);
			if(resp.success){
			   alertMsg('Proceso exitoso!','Oferta academica actualizada', 'success',2000);
			   jQuery('#frmModal').modal('hide');
			   setTimeout(function () {
					  window.location.href = '<?=PROOT?>ofertaAcademica'; //will redirect to your blog page (an ex: blog.html)
				   }, 1500);
			}else{
			   alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
			   return;
			}

		 }
	  });

	}

	// Muestra modal para agregar y para modificar un TOA0
	function showModalAgregarModificarOA(idOA){
	   // Envia al controlador roles
	  jQuery.ajax({
		 url : '<?=PROOT?>ofertaAcademica/nuevo',
		 method : "POST",
		 data: {
			idOA:idOA 
		 },
		 success : function(resp){
			//console.log(resp);
			jQuery('#modalTitulo').html('Gestión de Ofertas Académicas');
			jQuery('#bodyModal').html(resp);
			jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
			jQuery('#frmModal').modal('show');
		 }
	  });
	}	
	
	function guardarOA(){
				
		if ($('#txt_nombreOA').val() == '') {
			alertMsg('Información Incompleta!','Debe digitar un nombre para la oferta.', 'warning',2000);
			$('#txt_nombreOA').focus();
		   	return false;
		}else if ($('#cmb_tipoOA option:selected').text() == 'Seleccionar') {
			alertMsg('Información Incompleta!','Debe seleccionar un tipo de oferta.', 'warning',2000);
			$('#cmb_tipoOA').focus();
		   	return false;
		}else if ($('#txt_duracion').val() == '') {
			alertMsg('Información Incompleta!','Debe especificar una duración.', 'warning',2000);
			$('#txt_duracion').focus();
		   	return false;
		}else if ($('#cmb_estadoOA option:selected').text() == 'Seleccionar') {
			alertMsg('Información Incompleta!','Debe especificar una estado.', 'warning',2000);
			$('#cmb_estadoOA').focus();
		   	return false;
		}else if ($('#txt_descripcion').val() == '') {
			alertMsg('Información Incompleta!','Debe especificar una descripción.', 'warning',2000);
			$('#txt_descripcion').focus();
		   	return false;
		}/*else if ($('#adjuntoOA').val() == '') {
			alertMsg('Información Incompleta!','Debe adjuntar un catalogo para la oferta académica.', 'warning',2000);
			$('#adjuntoOA').focus();
		   	return false;
		}*/else{
		
			 var frmData = new FormData($('#frmOA')[0]);
			 if (document.getElementById("adjuntoOA").files.length == 0 ) { //if the file is empty
				   frmData.delete('adjuntoOA'); //remove it from the upload data
			 }
			 //console.log(frmData);return;

			 jQuery.ajax({
				url : '<?=PROOT?>ofertaAcademica/guardar',
				method: 'POST',
				data : frmData,
		 		contentType: false,
				cache: false,
				processData:false,
				 success: function(resp){
					console.log(resp);
					console.log(resp.success);
					if(resp.success){
					  alertMsg('Proceso exitoso!','El proceso culminó con exito', 'success',2000);
					  setTimeout(function () {
							 window.location.href = '<?=PROOT?>ofertaAcademica'; //will redirect to your blog page (an ex: blog.html)
						  }, 1500);
					}else{
					  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
					  return;
					}

				}
			 });		   
		   
		}//EndIfValidaciones			

		
	}
	
	function modificarOA(){
				
		//alert('attr: ' + $('#adjuntoOA').attr('value') + 'ValAdjunto: ' + $('#adjuntoOA').val());

		if ($('#txt_nombreOA').val() == '') {
			alertMsg('Información Incompleta!','Debe digitar un nombre para la oferta.', 'warning',2000);
			$('#txt_nombreOA').focus();
		   	return false;
		}else if ($('#cmb_tipoOA option:selected').text() == 'Seleccionar') {
			alertMsg('Información Incompleta!','Debe seleccionar un tipo de oferta.', 'warning',2000);
			$('#cmb_tipoOA').focus();
		   	return false;
		}else if ($('#txt_duracion').val() == '') {
			alertMsg('Información Incompleta!','Debe especificar una duración.', 'warning',2000);
			$('#txt_duracion').focus();
		   	return false;
		}else if ($('#cmb_estadoOA option:selected').text() == 'Seleccionar') {
			alertMsg('Información Incompleta!','Debe especificar una estado.', 'warning',2000);
			$('#cmb_estadoOA').focus();
		   	return false;
		}else if ($('#txt_descripcion').val() == '') {
			alertMsg('Información Incompleta!','Debe especificar una descripción.', 'warning',2000);
			$('#txt_descripcion').focus();
		   	return false;
		}else{
		
			 var frmData = new FormData($('#frmOA')[0]);
			 if (document.getElementById("adjuntoOA").files.length == 0 ) { //if the file is empty
				   frmData.delete('adjuntoOA'); //remove it from the upload data
			 }
			 //console.log(frmData);return;

			 jQuery.ajax({
				url : '<?=PROOT?>ofertaAcademica/editar',
				method: 'POST',
				data : frmData,
				contentType: false,
				cache: false,
				processData:false,
				success: function(resp){
					//console.log(resp);
					//console.log(resp.success);
					if(resp.success){
					  alertMsg('Proceso exitoso!','El proceso culminó con exito', 'success',2000);
					  setTimeout(function () {
							 window.location.href = '<?=PROOT?>ofertaAcademica'; //will redirect to your blog page (an ex: blog.html)
						  }, 1500);
					}else{
					  alertMsg('Proceso fallido!','Ha ocurrido un error: '+resp.errors, 'error',2000);
					  return;
					}

				}
			 });		   
		   
		}//EndIfValidaciones			

		
	}


</script>
<?php $this->end(); ?>