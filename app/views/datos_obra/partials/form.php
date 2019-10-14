<?php use Core\FH; ?>

<form class="form" id="frmDatosObra" onsubmit="return validarCampos(this)" action=<?=$this->postAction?> method="post" enctype="multipart/form-data">
	<div class="ibox-title text-center px-2 border gray-bg">
   		<h3 class="font-bold no-margins">Información general de la obra.</h3>
   		<p class="m-b-xs">Tenga en cuenta que los campos con * son obligatorios</p>
   	</div>
	<div class="ibox-content">
		<div class="row">
			<?= FH::inputBlock('text','Nombre de la obra','nombre_obra',$this->datos->nombre_obra,['class'=>'form-control'],['class'=>'form-group col-md-4'],[]) ?>

			<?= FH::selectBlock('Municipio *','municipio_id',$this->datos->municipio_id,$this->municipio,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-3'],[]) ?>

			<?= FH::inputBlock('text','Dirección de la obra','direccion',$this->datos->direccion,['class'=>'form-control'],['class'=>'form-group col-md-5'],[]) ?>
		</div>
		<div class="row">

			<?= FH::inputBlock('text','Descripción de la obra','descripcion',$this->datos->descripcion,['class'=>'form-control'],['class'=>'form-group col-md-12'],[]) ?>
		</div>
		<div class="row">
			<?= FH::inputBlock('number','Área del lote (m2)','area_lote',$this->datos->area_lote,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>
			
			<?= FH::inputBlock('number','Superficie construida (m2)','area_obra',$this->datos->area_obra,['class'=>'form-control'],['class'=>'form-group col-md-3 px-1'],[]) ?>

			<?= FH::selectBlock('Tipo de obra *','tipo_obra_id',$this->datos->tipo_obra_id,$this->tipo_obra,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-3'],[]) ?>
			
			<?= FH::selectBlock('Subtipo obra','subtipo_obra_id',$this->datos->subtipo_obra_id,$this->subtipo_obra,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-3'],[]) ?>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group" id="fecha_inicial">
	                <label class="font-normal">Fecha inicial de la obra *</label>
	                <div class="input-group date">
	                    <span class="input-group-addon">
	                    	<i class="fa fa-calendar"></i>
	                    </span>
	                    <input type="text" class="form-control" name="fecha_inicial" id="dtp_fecha_inicial" value="<?=$this->datos->fecha_inicial?>">
	                </div>
	            </div>
            </div>
            <div class="col-md-3">
				<div class="form-group" id="fecha_final">
	                <label class="font-normal">Fecha final de la obra *</label>
	                <div class="input-group date">
	                    <span class="input-group-addon">
	                    	<i class="fa fa-calendar"></i>
	                    </span>
	                    <input type="text" class="form-control" name="fecha_final" id="dtp_fecha_final" value="<?=$this->datos->fecha_final?>">
	                </div>
	            </div>
            </div>
			<?= FH::inputBlock('text','Tiempo estimado ejecución (en días)','plazo',$this->datos->plazo,['class'=>'form-control','readonly'=>'true'],['class'=>'form-group col-md-3'],[]) ?>
			
			<?= FH::selectBlock('Cuenta con Programa de Manejo Ambiental de RCD *','plan_manejo_rcd',$this->datos->plan_manejo_rcd,['1'=>'SI','0'=>'NO'],['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-3 small'],[]) ?>
		</div>
		<div class="row">
			<?= FH::selectBlock('Aprobado por la autoridad ambiental *','plan_aprob_autor_ambiental',$this->datos->plan_aprob_autor_ambiental,['1'=>'SI','0'=>'NO'],['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-3'],[]) ?>

			<?= FH::inputBlock('text','Cual autoridad?','cual_autoridad',$this->datos->cual_autoridad,['class'=>'form-control'],['class'=>'form-group col-md-6'],[]) ?>

			<div class="col-md-3 form-group">
				<label class="mb-1">Adjunte el programa de manejo ambiental</label>
				<div class="custom-file">
				   <input id="programa_manejo_ambiental" name="programa_manejo_ambiental" type="file" class="custom-file-input" value="<?=$this->datos->programa_manejo_ambiental?>">
				   <label for="programa_manejo_ambiental" class="custom-file-label text-truncate">
					   	<?php 
				   		if(empty($this->datos->programa_manejo_ambiental)):?>
				   			Seleccionar archivo 
			   			<?php else: 
			   				echo $this->datos->programa_manejo_ambiental; 
				   		endif;?>
				   		
				   	</label>
				</div>
			</div>
		</div>
		<div class="row">

			<?= FH::inputBlock('text','Descripción de actividades específicas de prevención y reducción de generación de rcd','descripcion_act_especifica',$this->datos->descripcion_act_especifica,['class'=>'form-control'],['class'=>'form-group col-md-12'],[]) ?>
		</div>
		<div class="row">
			<?= FH::inputBlock('number','Estimacion vida util del proyecto (en años)','estimacion_vida_util',$this->datos->estimacion_vida_util,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>

			<?= FH::inputBlock('text','Latitud, para georeferenciar','latitud',$this->datos->latitud,['class'=>'form-control'],['class'=>'form-group col-md-2'],[]) ?>

			<?= FH::inputBlock('text','Longitud','longitud',$this->datos->longitud,['class'=>'form-control'],['class'=>'form-group col-md-2'],[]) ?>

			<?= FH::selectBlock('Tiene sotano? *','sotano',$this->datos->sotano,['1'=>'SI','0'=>'NO'],['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'form-group col-md-2'],[]) ?>
			
			<?= FH::inputBlock('text','Volumen (m3)','volumen',$this->datos->volumen,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>
		</div>
	</div>

	<div class="ibox-title text-center px-2 border gray-bg">
    	<h3 class="font-bold no-margins">Datos del responsable de diligenciar la información</h3>
    </div>

	<div class="ibox-content">
		<div class="row">
			<?= FH::inputBlock('text','Número de documento *','documento_responsable',$this->datos->documento_responsable,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>
			
			<?= FH::inputBlock('text','Nombres del responsable *','nombres_responsable',$this->datos->nombres_responsable,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>

			<?= FH::inputBlock('text','Apellidos del responsable *','apellidos_responsable',$this->datos->apellidos_responsable,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>
			
			<?= FH::inputBlock('text','Celular del responsable','celular_responsable',$this->datos->celular_responsable,['class'=>'form-control'],['class'=>'form-group col-md-3'],[]) ?>
		</div>
		<div class="row">
			<?= FH::inputBlock('text','Cargo del responsable *','cargo',$this->datos->cargo,['class'=>'form-control'],['class'=>'form-group col-md-6'],[]) ?>

			<?= FH::inputBlock('text','Correo del responsable *','correo_responsable',$this->datos->correo_responsable,['class'=>'form-control'],['class'=>'form-group col-md-6'],[]) ?>
		</div>
	</div>

	<div class="ibox-title text-center px-2 border gray-bg">
    	<h3 class="font-bold no-margins">Adjuntar documentos</h3>
	</div>

	<div class="ibox-content">
		<div class="row justify-content-center">
			<table class="table-striped table-condensed table-bordered table-hover">
		        <thead class="bg-info text-center">
		            <th class="col-auto bg-success" >Tipo de documento</th>
		            <th class="col-auto bg-success">Adjuntar</th>
		        </thead>
		        <tbody>
		            <tr>
		              <td>Licencia de construcción</td>
		              <td>
		                <div class="custom-file">
						   <input id="licencia_construccion" name="licencia_construccion" value="<?=$this->datos->licencia_construccion?>" type="file" class="custom-file-input">
						   <label for="licencia_construccion"  class="custom-file-label text-truncate my-0"><?php if(empty($this->datos->licencia_construccion)):?>Seleccionar archivo <?php else: echo $this->datos->licencia_construccion; endif;?></label>
						</div>
		              </td>
		            </tr>
		             <tr>
		              <td>Licencia de demolicion. (si lo requiere)</td>
		              <td>
		                <div class="custom-file">
						   <input id="licencia_demolicion" name="licencia_demolicion" type="file" class="custom-file-input" value="<?=$this->datos->licencia_demolicion?>">
						   <label for="licencia_demolicion" class="custom-file-label text-truncate"><?php if(empty($this->datos->licencia_demolicion)):?>Seleccionar archivo <?php else: echo $this->datos->licencia_demolicion; endif;?></label>
						</div>
		              </td>
		            </tr>
		            <tr>
		              <td>Licencias de intervención y ocupación. (si lo requiere)</td>
		              <td>
		                <div class="custom-file">
						   <input id="licencia_espacio_publico" name="licencia_espacio_publico" type="file" class="custom-file-input" value="<?=$this->datos->licencia_espacio_publico?>">
						   <label for="licencia_espacio_publico"  class="custom-file-label text-truncate"><?php if(empty($this->datos->licencia_espacio_publico)):?>Seleccionar archivo <?php else: echo $this->datos->licencia_espacio_publico; endif;?></label>
						</div>
		              </td>
		            </tr>
		        </tbody>
			</table>
		</div>
		<div class="col-md-12">
			<div class="text-center mt-3">
				<a href="<?=PROOT?>datosObra" class="btn btn-primary">Volver</a>
				<?= FH::submitTag('Guardar e incluir materiales',['class'=>'btn btn-success']) ?>
			</div>
		</div>
	</div>
</form>