<?php $this->setSiteTitle('Editar Factura'); ?>
<?php $this->start('body');?>
<div class="card border-success">
  <div class="card-header text-center bg-success text-white">
    Editar Factura: <?=$this->datos->factura_no?>
  </div>
  <div class="card-body">
    <?php $this->partial('factura','form');?>
  </div>
</div>
<?php $this->end();?>