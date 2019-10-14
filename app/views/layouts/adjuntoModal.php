<?php $this->setSiteTitle('Visor de Documentos')?>
<?php $this->start('body')?>
	<?php 
		echo '<embed src="'.$this->urlAdjunto.'#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />'; 
	?>
<?php $this->end(); ?>