<?php use Core\FH; ?>
<form method="post" action="" id="frmSubTipoObra" role="form">
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],[]) ?>

		<?= FH::selectBlock('Tipo de obra *','tipo_obra_id',$this->datos->tipo_obra_id,$this->tipo_obra,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-6'],[]) ?>

		<?= FH::inputBlock('text','Subtipo de obra','subtipo_obra',$this->datos->subtipo_obra,['class'=>'form-control'],['class'=>'form-group col-md-6'],[]) ?>

	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <?php if(empty($this->datos->id)):?>
        	<button type="button" class="btn btn-primary" onClick="guardar();return;">Guardar</button>
    	<?php else:?>
    		<button type="button" class="btn btn-primary" onClick="actualizar();return;">Actualizar</button>
		<?php endif;?>
	</div>
</form>
