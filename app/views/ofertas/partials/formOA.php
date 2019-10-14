<?php use Core\FH; ?>
<form method="post" action="" id="frmOAcademicas" role="form">
	<?= FH::displayErrors($this->displayErrors) ?>
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-6 d-none'],$this->displayErrors) ?>

		<?= FH::inputBlock('hidden','ofertaAcademicaID: ','oa_id',$this->datos->oa_id,['class'=>'form-control'],['class'=>'form-group col-md-6 d-none'],$this->displayErrors) ?>

		<?= FH::inputBlock('hidden','UniversidadID: ','usuario_id',$this->OA->id_empresa,['class'=>'form-control'],['class'=>'form-group col-md-6 d-none'],$this->displayErrors) ?>
		
		<?= FH::inputBlock('text','Universidad: ','empresa',$this->empresa->razon_social,['class'=>'form-control','readOnly'=>true],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Producto: ','producto',$this->OA->nombre,['class'=>'form-control','readOnly'=>true],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Descripciones adicionales: ','descripcion',$this->datos->descripcion,['class'=>'form-control'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <?php if(empty($this->datos->id)):?>
        	<button type="button" class="btn btn-primary" onClick="guardarSolicitudOA();return;">Guardar</button>
    	<?php else:?>
    		<button type="button" class="btn btn-primary" onClick="actualizar();return;">Actualizar</button>
		<?php endif;?>
	</div>
</form>