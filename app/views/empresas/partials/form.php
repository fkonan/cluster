<?php use Core\FH; ?>
<form method="post" action="" id="frmEmpresas" role="form" enctype="multipart/form-data">
	<?= FH::displayErrors($this->displayErrors) ?>
	<?= FH::csrfInput() ?>
	<div class="row">
		<?= FH::inputBlock('hidden','Id','id',$this->datos->id,['class'=>'form-control'],['class'=>'form-group col-md-12 d-none'],$this->displayErrors) ?>
		
		<?= FH::inputBlock('text','Nit','nit',$this->datos->nit,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."empresas','validarDuplicado','nit',this);"],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
		
		<?= FH::inputBlock('text','Razón social','razon_social',$this->datos->razon_social,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Dirección','direccion',$this->datos->direccion,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Teléfono fijo','telefono_fijo',$this->datos->telefono_fijo,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Representante legal','representante_legal',$this->datos->representante_legal,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

		<?= FH::inputBlock('text','Teléfono de contaco','telefono_contacto',$this->datos->telefono_contacto,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<?= FH::inputBlock('text','Persona de contacto','nombre_contacto',$this->datos->nombre_contacto,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>

		<?= FH::selectBlock('Tipo de empresa','tipo_empresa_id',$this->datos->tipo_empresa_id,$this->tipo_empresa,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6'],$this->displayErrors) ?>
	</div>
	<div class="row">
		<div class="col-md-12">
	        <label>Logo de la empresa</label>
	        <div class="custom-file">
	            <input id="logo" name="logo" type="file" class="custom-file-input" value="<?=$this->datos->logo?>">
	            <label for="logo"  class="custom-file-label text-truncate">
	            	<?php if(empty($this->datos->logo)):?>Seleccionar logo <?php else: echo $this->datos->logo; endif;?>
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