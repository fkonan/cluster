<?php $this->setSiteTitle('Arquitectura - Linea Base - Oficinas Grandes')?>

<?php $this->start('body'); //var_dump($_GET); var_dump($_POST); ?>


<style>
	.chartdiv {
		width: 100%;
		height: 500px;
	}

	.carousel-control-prev, .carousel-control-next {
		color: red !important;
	}
</style>
<!-- Resources https://www.amcharts.com/demos/ -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<!-- Chart code -->
<script>

function addRemoveAnimationCorousel(op=0){
	
		if(op=='1'){
			//alert('Argegando interval');
			document.getElementById('carouselExampleIndicators').removeAttribute('data-interval');
			document.getElementById('carouselExampleIndicators').setAttribute('data-interval', '1000000');
			//$('.carousel').carousel('pause');
		}else{
			//alert('Eliminando interval');
			document.getElementById('carouselExampleIndicators').setAttribute('data-interval', '1000');
			//$('.carousel').carousel('cycle');
		}
	
}
	
am4core.ready(function() {

// Themes begin
//am4core.useTheme(am4themes_frozen);
am4core.useTheme(am4themes_animated);
// Themes end

//###########################################################################	
//############################ OCUPACION DE VIVIENDA L-V ####################
//###########################################################################
// Create chart instance
var chartOV = am4core.create("OcupacionViviendaLV", am4charts.XYChart);
// Add data
chartOV.data = [{
  "hora": "1",
  "porcentaje": 0
}, {
  "hora": "2",
  "porcentaje": 0
}, {
  "hora": "3",
  "porcentaje": 0
}, {
  "hora": "4",
  "porcentaje": 0
}, {
  "hora": "5",
  "porcentaje": 0
}, {
  "hora": "6",
  "porcentaje": 0
}, {
  "hora": "7",
  "porcentaje": 50
}, {
  "hora": "8",
  "porcentaje": 100
}, {
  "hora": "9",
  "porcentaje": 100
}, {
  "hora": "10",
  "porcentaje": 100
}, {
  "hora": "11",
  "porcentaje": 100
}, {
  "hora": "12",
  "porcentaje": 50
}, {
  "hora": "13",
  "porcentaje": 50
}, {
  "hora": "14",
  "porcentaje": 100
}, {
  "hora": "15",
  "porcentaje": 100
}, {
  "hora": "16",
  "porcentaje": 100
}, {
  "hora": "17",
  "porcentaje": 100
}, {
  "hora": "18",
  "porcentaje": 50
}, {
  "hora": "19",
  "porcentaje": 0
}, {
  "hora": "20",
  "porcentaje": 0
}, {
  "hora": "21",
  "porcentaje": 0
}, {
  "hora": "22",
  "porcentaje": 0
}, {
  "hora": "23",
  "porcentaje": 0
}];

// Create axes
var categoryAxis = chartOV.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "hora";
categoryAxis.renderer.grid.template.location = 1;
categoryAxis.renderer.minGridDistance = 23;
var valueAxis = chartOV.yAxes.push(new am4charts.ValueAxis());
//axisBreak.defaultState.transitionDuration = 1000;
	
// Create series
var series = chartOV.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "porcentaje";
series.dataFields.categoryX = "hora";
series.name = "porcentaje";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
//###########################################################################
//###########################################################################	

	
//###########################################################################	
//############################ APERTURA DE VIVIENDA L-V ####################
//###########################################################################	
// Create chart instance
var chartOV = am4core.create("AperturaViviendaLV", am4charts.XYChart);
// Add data
chartOV.data = [{
  "hora": "1",
  "porcentaje": 0
}, {
  "hora": "2",
  "porcentaje": 0
}, {
  "hora": "3",
  "porcentaje": 0
}, {
  "hora": "4",
  "porcentaje": 0
}, {
  "hora": "5",
  "porcentaje": 0
}, {
  "hora": "6",
  "porcentaje": 0
}, {
  "hora": "7",
  "porcentaje": 0
}, {
  "hora": "8",
  "porcentaje": 100
}, {
  "hora": "9",
  "porcentaje": 100
}, {
  "hora": "10",
  "porcentaje": 100
}, {
  "hora": "11",
  "porcentaje": 100
}, {
  "hora": "12",
  "porcentaje": 100
}, {
  "hora": "13",
  "porcentaje": 100
}, {
  "hora": "14",
  "porcentaje": 100
}, {
  "hora": "15",
  "porcentaje": 100
}, {
  "hora": "16",
  "porcentaje": 100
}, {
  "hora": "17",
  "porcentaje": 100
}, {
  "hora": "18",
  "porcentaje": 0
}, {
  "hora": "19",
  "porcentaje": 0
}, {
  "hora": "20",
  "porcentaje": 0
}, {
  "hora": "21",
  "porcentaje": 0
}, {
  "hora": "22",
  "porcentaje": 0
}, {
  "hora": "23",
  "porcentaje": 0
}];

// Create axes
var categoryAxis = chartOV.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "hora";
categoryAxis.renderer.grid.template.location = 1;
categoryAxis.renderer.minGridDistance = 23;
var valueAxis = chartOV.yAxes.push(new am4charts.ValueAxis());
//axisBreak.defaultState.transitionDuration = 1000;
	
// Create series
var series = chartOV.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "porcentaje";
series.dataFields.categoryX = "hora";
series.name = "porcentaje";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;	
//###########################################################################
//###########################################################################
	

//###########################################################################	
//############################   OCUPACION VIVIENDA S-D  ####################
//###########################################################################	
// Create chart instance
var chartOV = am4core.create("OcupacionViviendaSD", am4charts.XYChart);
// Add data
chartOV.data = [{
  "hora": "1",
  "porcentaje": 0
}, {
  "hora": "2",
  "porcentaje": 0
}, {
  "hora": "3",
  "porcentaje": 0
}, {
  "hora": "4",
  "porcentaje": 0
}, {
  "hora": "5",
  "porcentaje": 0
}, {
  "hora": "6",
  "porcentaje": 0
}, {
  "hora": "7",
  "porcentaje": 0
}, {
  "hora": "8",
  "porcentaje": 50
}, {
  "hora": "9",
  "porcentaje": 50
}, {
  "hora": "10",
  "porcentaje": 50
}, {
  "hora": "11",
  "porcentaje": 50
}, {
  "hora": "12",
  "porcentaje": 50
}, {
  "hora": "13",
  "porcentaje": 25
}, {
  "hora": "14",
  "porcentaje": 25
}, {
  "hora": "15",
  "porcentaje": 25
}, {
  "hora": "16",
  "porcentaje": 25
}, {
  "hora": "17",
  "porcentaje": 0
}, {
  "hora": "18",
  "porcentaje": 0
}, {
  "hora": "19",
  "porcentaje": 0
}, {
  "hora": "20",
  "porcentaje": 0
}, {
  "hora": "21",
  "porcentaje": 0
}, {
  "hora": "22",
  "porcentaje": 0
}, {
  "hora": "23",
  "porcentaje": 0
}];

// Create axes
var categoryAxis = chartOV.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "hora";
categoryAxis.renderer.grid.template.location = 1;
categoryAxis.renderer.minGridDistance = 23;
var valueAxis = chartOV.yAxes.push(new am4charts.ValueAxis());
//axisBreak.defaultState.transitionDuration = 1000;
	
// Create series
var series = chartOV.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "porcentaje";
series.dataFields.categoryX = "hora";
series.name = "porcentaje";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;	
//###########################################################################
//###########################################################################
	

//###########################################################################	
//############################ APERTURA DE VIVIENDA S-D  ####################
//###########################################################################	
// Create chart instance
var chartOV = am4core.create("AperturaViviendaSD", am4charts.XYChart);
// Add data
chartOV.data = [{
  "hora": "1",
  "porcentaje": 0
}, {
  "hora": "2",
  "porcentaje": 0
}, {
  "hora": "3",
  "porcentaje": 0
}, {
  "hora": "4",
  "porcentaje": 0
}, {
  "hora": "5",
  "porcentaje": 0
}, {
  "hora": "6",
  "porcentaje": 0
}, {
  "hora": "7",
  "porcentaje": 0
}, {
  "hora": "8",
  "porcentaje": 100
}, {
  "hora": "9",
  "porcentaje": 100
}, {
  "hora": "10",
  "porcentaje": 100
}, {
  "hora": "11",
  "porcentaje": 100
}, {
  "hora": "12",
  "porcentaje": 100
}, {
  "hora": "13",
  "porcentaje": 0
}, {
  "hora": "14",
  "porcentaje": 0
}, {
  "hora": "15",
  "porcentaje": 0
}, {
  "hora": "16",
  "porcentaje": 0
}, {
  "hora": "17",
  "porcentaje": 0
}, {
  "hora": "18",
  "porcentaje": 0
}, {
  "hora": "19",
  "porcentaje": 0
}, {
  "hora": "20",
  "porcentaje": 0
}, {
  "hora": "21",
  "porcentaje": 0
}, {
  "hora": "22",
  "porcentaje": 0
}, {
  "hora": "23",
  "porcentaje": 0
}];

// Create axes
var categoryAxis = chartOV.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "hora";
categoryAxis.renderer.grid.template.location = 1;
categoryAxis.renderer.minGridDistance = 23;
var valueAxis = chartOV.yAxes.push(new am4charts.ValueAxis());
//axisBreak.defaultState.transitionDuration = 1000;
	
// Create series
var series = chartOV.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "porcentaje";
series.dataFields.categoryX = "hora";
series.name = "porcentaje";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;	
//###########################################################################
//###########################################################################
	
	
}); // end am4core.ready()
</script>

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
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOG1.png" alt="Arquitectura Oficinas Grandes Mod. 1">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOG2.png" alt="Arquitectura Oficinas Grandes Mod. 2">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOG3.png" alt="Arquitectura Oficinas Grandes Mod. 3">
    </div>
	<div class="carousel-item">
      <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/arqOG4.png" alt="Arquitectura Oficinas Grandes Mod. 3">
    </div>
	<div class="carousel-item">
      <!-- <img class="d-block w-100" src="<?=PROOT?>img/modulos/arquitectura/ocupacionOG.png" alt="Arquitectura Ofocinas Grandes Ocupación De Vivienda"> -->
		
		
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

