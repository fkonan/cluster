<?php
use Core\FH;
use Core\H;
//echo "<h1>".$this->postAction."</h1>";
?>


<form method="post" action="" id="frmNuevaOA" role="form">
   <div class="row text-center">
	  <p align="center">
		<?=FH::inputBlock('text','idTOA','txt_idTOA',$this->idTOA,['class'=>'form-control'], ['class'=>'col-md-12 form-group d-none']);?>
	  	<?=FH::inputBlock('text','Nombre Tipo Oferta Académica','txt_nomTOA',$this->nomTOA,['class'=>'form-control','onChange'=>"validarDuplicidad('".PROOT."tipoOfertaAcademica','validarDuplicado','nombre',this);",'nom'=>'nombre'],['class'=>'col-md-12 form-group']);?>
	  </p>
   </div>
   <div class="modal-footer">
	  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	  <?php
	  	if(isset($this->idTOA) && $this->idTOA==''){
			echo '<button type="button" class="btn btn-primary" onclick="guardarTOA();">Guardar</button>';
		}else{
			echo '<button type="button" class="btn btn-primary" onclick="modificarTOA('.$this->idTOA.', \''.$this->nomTOA.'\');">Actualizar</button>';
		}
	  ?>
	   
   </div>
</form>
