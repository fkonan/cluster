<?php $this->setSiteTitle('Arquitectura - Linea Base - Oficinas Pequeñas')?>

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
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOP1.png" alt="Arquitectura Oficinas Pequeñas Mod. 1">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOP2.png" alt="Arquitectura Oficinas Pequeñas Mod. 2">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOP3.png" alt="Arquitectura Oficinas Pequeñas Mod. 3">
    </div>
	<div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOP4.png" alt="Arquitectura Oficinas Pequeñas Mod. 3">
    </div>
	<div class="carousel-item">
      <!-- <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/ocupacionOP.png" alt="Arquitectura Ofocinas Pequeñas Ocupación De Vivienda"> -->
		
		<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin: 2% 10% !important; padding: 2% 10% !important;">
			<li class="nav-item">
			<a class="nav-link active" id="tab-1" data-toggle="tab" href="#1" role="tab" aria-controls="1"
			  aria-selected="true">Ocupación Oficinas L-V</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="tab-2" data-toggle="tab" href="#2" role="tab" aria-controls="2"
			  aria-selected="false">Apertura Oficinas L-V</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="tab-3" data-toggle="tab" href="#3" role="tab" aria-controls="3"
			  aria-selected="false">Ocupación Oficinas S-D</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="tab-4" data-toggle="tab" href="#4" role="tab" aria-controls="4"
			  aria-selected="false">Apertura Oficinas S-D</a>
		  	</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="1" role="tabpanel" aria-labelledby="tab-1">
				<h1 align="center">Ocupación Oficinas L-V</h1>
				<div id="OcupacionViviendaLV" class="chartdiv"></div>
			</div>
			<div class="tab-pane fade" id="2" role="tabpanel" aria-labelledby="tab-2">
				<h1 align="center">Apertura Oficinas L-V</h1>
				<div id="AperturaViviendaLV" class="chartdiv"></div>
			</div>
			<div class="tab-pane fade" id="3" role="tabpanel" aria-labelledby="tab-3">
				<h1 align="center">Ocupación Oficinas S-D</h1>
				<div id="OcupacionViviendaSD" class="chartdiv"></div>
			</div>
			<div class="tab-pane fade" id="4" role="tabpanel" aria-labelledby="tab-4">
				<h1 align="center">Apertura Oficinas S-D</h1>
				<div id="AperturaViviendaSD" class="chartdiv"></div>
			</div>
		</div>		
		
		
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

