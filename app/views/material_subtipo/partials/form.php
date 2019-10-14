<?php use Core\FH; ?>
<form method="post" action="" id="frmMaterialSubTipo" role="form">
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],[]) ?>

		<?= FH::selectBlock('Tipo de material *','tipo_id',$this->datos->tipo_id,$this->tipo,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-6'],[]) ?>

		<?= FH::inputBlock('text','Subtipo de material','subtipo',$this->datos->subtipo,['class'=>'form-control'],['class'=>'form-group col-md-6'],[]) ?>

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
