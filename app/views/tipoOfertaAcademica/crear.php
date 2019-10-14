<?php $this->setSiteTitle('Registro de Tipo de Oferta Académica')?>
<?php $this->start('body')?>
	<?php 
		//echo "Hola Tipo de Oferta Académica<br>";
		$this->partial('tipoOfertaAcademica','form_tipo');
	?>
<?php $this->end(); ?>