function validarDuplicidad(controlador,metodo,nombre_campo,valor){
	var label = $('label[for="' + $(valor).attr('id') + '"]');
	var texto=label[0]['innerHTML'];
	valor=valor.value;
	jQuery.ajax({
        url : controlador+'/'+metodo+'/'+nombre_campo+'/'+valor,
        method: "POST",
        success: function(resp){
			if(resp.success){
				swal({
				    title: 'Validación de duplicidad',
				    text: 'El campo: ' +texto+' ya se encuentra registrado. '+resp.mensaje,
				    type: 'warning',
				    timer: 3000,
					showConfirmButton: false,
					button: false
			  	});
           }
        }
    });
}

function mostrarContenidoEnMedio(msg){
	//alert('Mostrando Contenido');
	$('#page-wrapper').removeClass("gray-bg");
	$('#page-wrapper').attr("css", { backgroundColor: "white !important;" });
	$('#page-wrapper').html(msg+'</div><div class="footer text-white" style="background-color: #293846 !important;"><strong>Copyright</strong> CLUSTER DE CONSTRUCCIÓN DE SANTANDER. &copy; <?= date("Y");?>');
	//$('#contenido').html(msg);
}


