<?php use Core\FH; ?>
<form class="form" action=<?=$this->postAction?> method="post"> 
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::selectBlock('Seleccione el cliente *','cliente_id',$this->datos->cliente_id,$this->clientes,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-4'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Factura número','factura_no',$this->datos->factura_no,['class'=>'form-control'],['class'=>'form-group col-md-4'],$this->displayErrors) ?>

		<?= FH::selectBlock('Seleccione el producto *','producto_id',$this->factura_detalle->producto_id,$this->productos,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-4'],$this->displayErrors) ?>

	</div>
	<div class="row">
		<?= FH::inputBlock('text','Cantidad','cantidad',$this->factura_detalle->cantidad,['class'=>'form-control'],['class'=>'form-group col-md-4'],$this->displayErrors) ?>
		<?= FH::inputBlock('text','Valor','valor',$this->factura_detalle->valor,['class'=>'form-control'],['class'=>'form-group col-md-4'],$this->displayErrors) ?>
		<?= FH::inputBlock('text','Fecha factura','fecha',$this->datos->fecha,['class'=>'form-control'],['class'=>'form-group col-md-4'],$this->displayErrors) ?>
	</div>
	<div class="d-flex justify-content-end">
		<a href="<?=PROOT?>factura" class="btn btn-primary btn-xs float-right">Volver</a>
		<?= FH::submitTag('Guardar',['class'=>'btn btn-success ml-2']) ?>
	</div>
</form>
<script>
$(document).ready(function() {
    $('#cliente_id').select2({

    });

 	var hoy;
    hoy = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());

    $('#fecha').datepicker({
    	 maxDate: hoy,
    	 uiLibrary: 'bootstrap4' ,
    	 format: 'yyyy-mm-dd'
    });

    $('#producto_id').select2({

    });

    $('#producto_id').on('select2:select', function (e) {
	    var data = e.params.data;
	    cargarValor(data.id);
	});

	function cargarValor(id){
		$.ajax({
			type: "POST",
			url : '<?=PROOT?>producto/cargarValor/'+id,
			success : function(resp){
				if(resp.success){
					$('#valor').val(resp.datos.valor);
				}else{
					//alertMsg('Ha ocurrido un error', 'danger');
					$('#valor').val(0);
				}
			}
		});
	}
});
</script>
