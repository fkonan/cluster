<?php $this->setSiteTitle('Editar obra'); ?>
<?php $this->start('body');?>
<div class="card border-danger">
  <div class="card-header text-center bg-red text-white">
    Editar obra
  </div>
  <div class="card-body pt-1">
    <?php $this->partial('datos_obra','form');?>
  </div>
</div>
<?php $this->end(); ?>
