<?php $this->setSiteTitle('Nuevo Proyecto'); ?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body');?>

<div class="card border-info m-b-xs">
	<div class="card-header text-center bg-success text-white py-2">
		<h3>Incluir Proyecto</h3>
	</div>
	<div class="ibox shadow-none mb-1">
		<?php $this->partial('datos_obra','form');?>
	</div>
</div>

<?php $this->end();?>

<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?=PROOT?>js/plugins/fullcalendar/moment.min.js"></script>

<script>
	$(document).ready(function () {
		$("#frmDatosObra").validate({
			lang: 'es',
			rules: {
				nombre_obra: {
					required: true
				},
				municipio_id: {
					required: true
				},
				direccion: {
					required: true
				},
				tipo_obra_id: {
					required: true
				},
				sotano: {
					required: true
				},
				fecha_inicial: {
					required: true
				},
				fecha_final: {
					required: true
				},
				documento_responsable: {
					required: true
				},
				nombres_responsable: {
					required: true
				},
				apellidos_responsable: {
					required: true
				},
				cargo: {
					required: true
				},
				correo_responsable: {
					required: true
				},
				plan_aprob_autor_ambiental:{
					required:true
				}
			},
			messages: {
				nombre_obra: {
					required:"El nombre de la obra es requerido."
				},
				municipio_id: {
					required:"El municipio es requerido."
				},
				direccion: {
					required:"La dirección es requerido."
				},
				tipo_obra_id: {
					required:"El tipo de obra es requerido."
				},
				sotano: {
					required:"El sotano es requerido."
				},
				fecha_inicial: {
					required:"La fecha inicial de obra es requerido."
				},
				fecha_final: {
					required:"La fecha final es requerido."
				},
				documento_responsable: {
					required:"El documento del responsable es requerido."
				},
				nombres_responsable: {
					required:"Los nombres del responsable es requerido."
				},
				apellidos_responsable: {
					required:"Los apellidos del responsable es requerido."
				},
				cargo: {
					required:"El cargo es requerido."
				},
				correo_responsable: {
					required:"El correo del responsable es requerido."
				},
				plan_aprob_autor_ambiental: {
					required:"Aprobado por autoridad... es requerido."
				}
			}
      	});

		$('#fecha_inicial .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
			todayHighlight: true,
			locale: 'es-es'
        }).on('change', function(e) {
        	if($("#dtp_fecha_final").val()){
    			var fecha_inicial=moment(new Date($("#dtp_fecha_inicial").val()));
        		var fecha_final=moment(new Date($("#dtp_fecha_final").val()));
    			var plazo=fecha_final.diff(fecha_inicial,'days');
        		$("#plazo").val(plazo);
        	}
    	});

        $('#fecha_final .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
			todayHighlight: true,
			locale: 'es-es'
        }).on('change', function(e) {

        	if($("#dtp_fecha_inicial").val()){
				var fecha_inicial=moment(new Date($("#dtp_fecha_inicial").val()));
        		var fecha_final=moment(new Date($("#dtp_fecha_final").val()));
    			var plazo=fecha_final.diff(fecha_inicial,'days');
        		$("#plazo").val(plazo);
			}	
    	});
	});

	function validarCampos(form){
		var validar = form.valid();
		console.log(validaar);return false;
	}

	$('#area_lote').on('change',function(){
		var area_lote=0;
		var area_obra=0;
		if (!this.value=='')
			area_lote=this.value;

		if ($('#area_obra').val()!='')
			area_obra=$('#area_obra').val();

		if(parseInt(area_lote)>parseInt(area_obra)){
			alertMsg('Validación de campos','El área del lote no puede ser mayor a la superficie construida.','error',3000);
		}
	});

	$('#area_obra').on('change',function(){
		var area_lote=0;
		var area_obra=0;
		if (!this.value=='')
			area_obra=this.value;

		if ($('#area_lote').val()!='')
			area_lote=$('#area_lote').val();

		if(parseInt(area_lote)>parseInt(area_obra)){
			alertMsg('Validación de campos','El área del lote no puede ser mayor a la superficie construida.','error',3000);
		}
	});

	$('#tipo_obra_id').on('change',function(){
		$.ajax({
			type: "POST",
			url : '<?=PROOT?>datosObra/cargarSubtipoObra/'+this.value,
			success : function(resp){
				if(resp.success){
					var html='';
					html += '<option value="">Seleccionar</option>';
					$.each(resp.subtipo, function(idx, opt) {
						html += '<option value="'+idx+'">'+opt+'</option>';
					});
					$('#subtipo_obra_id').html(html);
					$('#subtipo_obra_id').prop('disabled',false);
				}else{

				}
			}
		});
	});

	$('#sotano').on('change',function(){
		if (this.value==1){
			$('#volumen').val(0);
			$('#volumen').attr('readonly',false);
			$('#volumen').focus();
		}else{
			$('#volumen').val(0);
			$('#volumen').attr('readonly',true);
		}	
	});

	$('.custom-file-input').on('change', function() { 
		let fileName = $(this).val().split('\\').pop(); 
		console.log(filename);
		$(this).next('.custom-file-label').addClass("selected").html(fileName); 
	});
</script>
<?php $this->end(); ?>