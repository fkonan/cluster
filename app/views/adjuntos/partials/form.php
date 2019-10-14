<?php use Core\FH; ?>
<form method="post" action="" id="frmAdjuntos" role="form" enctype="multipart/form-data">
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Título del documento','titulo',$this->datos->titulo,['class'=>'form-control'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Descripción del documento','descripcion',$this->datos->descripcion,['class'=>'form-control'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>

			<?= FH::inputBlock('text','Autor del documento','autor',$this->datos->autor,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

			<div class="col-md-5 pl-0">
				<label >Documento</label>
				<input id="archivo" name="archivo" type="file" class="custom-file-input">
				<label for="archivo" class="custom-file-label mt-4">Seleccione archivo...</label>
				<small>Tipos de archivos permitidos: (Pdf, Word).</small>
			</div>
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
