<?php
use Core\FH;
use Core\H;
?>

<form method="post" action="" id="frmOA" role="form" enctype="multipart/form-data">

	   
	<div class="row">
	<!-- txtIDOfertaAcadémica -->
		<?=FH::inputBlock('text','Id Oferta Académica','txt_idOA',$this->ofertaAcademica->id,['class'=>'form-control','id'=>'txt_idOA'],['class'=>'col-md-6 form-group d-none'],$this->displayErrors);?> 

		<?=FH::inputBlock('text','Id Empresa','txt_empresa',$this->empresaID,['class'=>'form-control','id'=>'txt_empresa'],['class'=>'col-md-6 form-group d-none'],$this->displayErrors);?> 
	</div>  

	<div class="row">
	<!-- txtIDOfertaAcadémica -->
		<?=FH::inputBlock('text','Nombre: ','txt_nombreOA',$this->ofertaAcademica->nombre,['class'=>'form-control','id'=>'txt_nombreOA'],['class'=>'col-md-6 form-group'],$this->displayErrors);?> 
				
		<?= FH::selectBlock('Tipo de Oferta:','cmb_tipoOA', $this->ofertaAcademica->tipo_oferta, $this->arr_TO,['class'=>'form-control', 'id'=>'cmb_tipoOA', 'placeHolder'=>'seleccione'],['class'=>'col-md-6 form-group'],$this->displayErrors) ?>
	</div> 

	<div class="row">
	<!-- txtIDOfertaAcadémica -->
		<?=FH::inputBlock('text','Duración:','txt_duracion',$this->ofertaAcademica->nombre,['class'=>'form-control','id'=>'txt_duracion'],['class'=>'col-md-6 form-group'],$this->displayErrors);?> 
				
		<?= FH::selectBlock('Estado de Oferta: ','cmb_estadoOA',$this->ofertaAcademica->estado,['1'=>'Activo', '0'=>'Inactivo'],['class'=>'form-control', 'id'=>'cmb_estadoOA', 'placeHolder'=>'seleccione'],['class'=>'col-md-6 form-group'],$this->displayErrors) ?>
	</div>
	
	<div class="row">
	<!-- txtIDOfertaAcadémica -->
		<?=FH::textareaBlock('Descripción: ','txt_descripcion',$this->ofertaAcademica->comentarios,['class'=>'form-control', 'rows'=>'5', 'id'=>'txt_descripcion'],['class'=>'col-md-12 form-group'],$this->displayErrors);?> 
	</div>
	
	<div class="row">
		<div class="col-md-12">
	        <label>Portafolio Adjunto (.pdf):</label>
	        <div class="custom-file">
	            <input id="adjuntoOA" name="adjuntoOA" type="file" class="custom-file-input" value="<?=$this->ofertaAcademica->adjunto?>" accept="application/pdf">
	            <label for="logo"  class="custom-file-label text-truncate">
	            	<?php 
						if(empty($this->ofertaAcademica->adjunto)){
					   		echo 'Seleccionar portafolio (PDF)';
						}else{
						   echo $this->ofertaAcademica->adjunto; 
						}
					?>
            	</label>
            </div>
     	</div>
    </div>
	</br>
    <div class="row text-right pt-2">
		<div class="col-md-12">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<?php if(empty($this->ofertaAcademica->id)):?>
				<button type="button" class="btn btn-primary" onClick="guardarOA();return;">Guardar</button>
			<?php else:?>
				<button type="button" class="btn btn-primary" onClick="modificarOA();return;">Actualizar</button>
			<?php endif;?>
		</div>
	</div>	
	
</form>


