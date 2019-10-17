<?php $this->setSiteTitle('Archivo Climatico')?>

<?php $this->start('body'); //var_dump($_GET); var_dump($_POST); ?>
<div class="card border-info">
	<!--
	<div class="card-header text-center bg-success text-white">
		Contenido Externo Incluido
	</div>	
	-->

<div class="row text-center" style="padding: 5%;">      
   <div class="col-lg-12">

         <div class="ibox-content">
            <a href="<?=PROOT?>/documentos/Archivo_Climatico_AMB.zip" class="btn btn-primary" style="padding: 1%;">
               <h3>Descargar Archivo Climatico</h3>
			<img src="<?=PROOT?>img/pdf.png">
            </a>

         </div>
	   
   </div>

</div>	
	
</div>
<?php $this->end(); ?>

