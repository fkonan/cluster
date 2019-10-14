<?php $this->setSiteTitle('Editar Oferta Académica')?>
<?php $this->start('body')?>
<div class="row align-items-center justify-content-center">
	<div class="col-md-12 bg-light p-3">
		<h3 class="text-center">Oferta ID: <?=$this->newUser->user?></h3><hr>
		<?php $this->partial('ofertaAcademica','frm_crearoa.php')?>
	</div>
</div>
<?php $this->end()?>