<?php use Core\FH; ?>
<form method="post" action="" id="frmProductos" role="form">
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>

		<?= FH::selectBlock('Tipo de producto','tipo_producto_id',$this->datos->tipo_producto_id,$this->tipo_producto,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Nombre del producto','producto',$this->datos->producto,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
		
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Descripción del Ciiu','ciiu',$this->datos->ciiu,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

		<?= FH::selectBlock('Modulo','modulo_id',$this->datos->modulo_id,$this->modulo,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<div class="col-md-12">
	        <label>Adjunto (brochure)</label>
	        <div class="custom-file">
	            <input id="adjunto" name="adjunto" type="file" class="custom-file-input" value="<?=$this->datos->adjunto?>">
	            <label for="adjunto"  class="custom-file-label text-truncate">
	            	<?php if(empty($this->datos->adjunto)):?>Seleccionar adjunto <?php else: echo $this->datos->adjunto; endif;?>
            	</label>
            </div>
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
