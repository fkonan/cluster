<?php $this->setSiteTitle('Agua - Linea Base - VIS')?>

<?php $this->start('body'); //var_dump($_GET); var_dump($_POST); ?>
<div class="card border-info">
	<!--
	<div class="card-header text-center bg-success text-white">
      Listado de empresas
   	</div>
	-->
   <div class="card-body pt-2">

	   
	   
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/agua/aguVis1.png" alt="Agua VIS Mod. 1">
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

