<?php use Core\FH; ?>
<form method="post" action="" id="frmOfertas" role="form">
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>

		<?= FH::inputBlock('hidden','Producto','producto_id',$this->datos->producto_id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Empresa','empresa',$this->empresa->razon_social,['class'=>'form-control','readOnly'=>true],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Producto','producto',$this->producto->producto,['class'=>'form-control','readOnly'=>true],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Descripciones adicionales','descripcion',$this->datos->descripcion,['class'=>'form-control'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
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