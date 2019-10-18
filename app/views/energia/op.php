<?php $this->setSiteTitle('Energia - Linea Base - Oficinas Pequeñas')?>

<?php $this->start('body'); //var_dump($_GET); var_dump($_POST); ?>
<div class="card border-info">

   <div class="card-body pt-2">
   
	   
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
	<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/energia/eneOP1.png" alt="Energia Oficinas Pequeñas Mod. 1">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/energia/eneOP2.png" alt="Energia Oficinas Pequeñas Mod. 2">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/energia/eneOP3.png" alt="Energia Oficinas Pequeñas Mod. 3">
    </div>
	<div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/energia/eneOPHVAC.png" alt="Energia Oficinas Pequeñas Mod. 3">
    </div>
	<div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/energia/usoHVACOP.png" alt="Energia Oficinas Pequeñas Mod. 4">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>	   
	   
	   
   </div>
</div>
<?php $this->end(); ?>

