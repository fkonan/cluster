<?php $this->setSiteTitle('Datos obras')?>

<?php $this->start('head'); ?>
    <link rel="stylesheet" href="<?=PROOT?>css/footable/footable.standalone.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-danger">
  <div class="card-header text-center bg-red text-white">
    Listado de obras
  </div>
  <div class="card-body pt-2">
    <a href="<?=PROOT?>datosObra/nuevo" class="btn btn-info btn-xs float-right mb-2">Nuevo registro</a>
    <div class="table-responsive">
      <table class="table table-striped table-condensed table-bordered table-hover">
        <thead class="bg-info text-center">
          <th class="col-auto">Nombre de la obra</th>
          <th class="col-auto">Dirección</th>
          <th class="col-auto">Fecha inicial</th>
          <th class="col-auto">Fecha final</th>
          <th class="col-auto">Responsable de la información</th>
          <th class="col-auto" data-filterable="false">Acciones</th>
        </thead>
        <tbody>
          <?php foreach($this->datos as $datos): ?>
            <tr>
              <td><?= $datos->nombre_obra; ?></a></td>
              <td><?= $datos->direccion; ?></a></td>
              <td><?= $datos->fecha_inicial; ?></a></td>
              <td><?= $datos->fecha_final; ?></a></td>
              <td><?= $datos->nombres_responsable . ' '. $datos->apellidos_responsable; ?></a></td>
              <td class="text-center">
                <div class="row mx-0">
                    <div class="col-md-6 mx-0 px-0">
                      <a href="<?=PROOT?>datosObra/editar/<?=$datos->id?>" class="btn btn-info btn-block">
                        Actualizar obra
                      </a>
                    </div>
                    <div class="col-md-6 mx-0 px-1">
                      <a href="<?=PROOT?>datosObra/eliminar/<?=$datos->id?>" class="btn btn-danger btn-block">
                        Eliminar obra
                      </a>
                    </div>
                  </div>
                  <div class="row mx-0 mt-1">
                    <!--
                    <div class="col-md-12 mx-0">
                      <a href="<?=PROOT?>rcd/index/<?=$datos->id?>" class="btn btn-success btn-sm btn-block">
                         Registro (RCD)
                      </a>
                    </div>
                  -->
                    <!--<div class="col-md-4 pl-2 px-0">
                      <a href="<?=PROOT?>datosObra/eliminar/<?=$datos->id?>" class="btn btn-danger btn-sm btn-block" onclick="if(!confirm('Desea eliminar este registro?')){return false;}">
                         Eliminar
                      </a>
                    </div>
					-->
                  </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
  <script src="<?=PROOT?>js/footable/footable.js"></script>
  <script src="<?=PROOT?>js/footable/footableConfig.js"></script>
<?php $this->end(); ?>