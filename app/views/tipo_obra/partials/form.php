<?php use Core\FH; ?>
<form method="post" action="" id="frmTipoObra" role="form">
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],[]) ?>
		<?= FH::inputBlock('text','Tipo de obra','tipo_obra',$this->datos->tipo_obra,['class'=>'form-control'],['class'=>'form-group col-md-12'],[]) ?>
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
