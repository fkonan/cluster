<?php $this->setSiteTitle('Editar usuario')?>
<?php $this->start('body')?>
<div class="row align-items-center justify-content-center">
	<div class="col-md-12 bg-light p-3">
		<h3 class="text-center">Editar usuario: <?=$this->newUser->user?></h3><hr>
		<?php $this->partial('users','form')?>
	</div>
</div>
<?php $this->end()?>