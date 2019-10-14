<?php use Core\FH; ?>
<form method="post" action="" id="frmResponder" role="form">
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->demanda->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Empresa','razon_social',$this->empresa->razon_social,['class'=>'form-control','readOnly'=>true],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Responder a la solicitud','respuesta',$this->datos->respuesta,['class'=>'form-control'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <?php if(empty($this->datos->id)):?>
        	<button type="button" class="btn btn-primary" onClick="guardarRespuesta();return;">Guardar</button>
    	<?php else:?>
    		<button type="button" class="btn btn-primary" onClick="actualizar();return;">Actualizar</button>
		<?php endif;?>
	</div>
</form>
