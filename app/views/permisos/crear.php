<?php $this->setSiteTitle('Nueva discapacidad'); ?>
<?php $this->start('body');?>
<div class="card border-success">
  <div class="card-header text-center bg-success text-white">
    Nueva discapacidad
  </div>
  <div class="card-body">
    <?php $this->partial('discapacidad','form');?>
  </div>
</div>
<?php $this->end(); ?>