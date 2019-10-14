<?php use Core\FH; ?>
<form method="post" action="" id="frmDemandas" role="form">
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::selectBlock('Sector *','sector_id',$this->datos->sector_id,$this->sectores,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Descripción de la solicitud','descripcion',$this->datos->descripcion,['class'=>'form-control'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
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
