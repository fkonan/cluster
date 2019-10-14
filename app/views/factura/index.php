<?php $this->setSiteTitle('Facturas')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/footable/footable.standalone.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-success">
  <div class="card-header text-center bg-success text-white">
    Listado de facturas
  </div>
  <div class="card-body pt-2">
    <a href="<?=PROOT?>factura/nuevo" class="btn btn-info btn-xs float-right mb-2">Nuevo registro</a>
    <div class="table-responsive">
      <table class="table table-striped table-condensed table-bordered table-hover">
        <thead class="bg-info text-center">
          <th class="col-auto">Número de fatcura</th>
          <th class="col-auto">Nombre del cliente</th>
          <th class="col-auto">Teléfono</th>
          <th class="col-auto">Celular</th>
          <th class="col-auto">Producto</th>
          <th class="col-auto">Cantidad</th>
          <th class="col-auto">Valor</th>
          <th class="col-auto">Fecha de la factura</th>
          <th class="col-auto">Fecha de notificación</th>
          <th class="col-auto" data-filterable="false">Acciones</th>
        </thead>
        <tbody class="small">
          <?php foreach($this->datos as $datos): ?>
            <tr>
              <td><?= $datos->factura_no; ?></a></td>
              <td><?= $datos->nombre; ?></a></td>
              <td><?= $datos->telefono; ?></a></td>
              <td><?= $datos->celular; ?></a></td>
              <td><?= $datos->producto; ?></a></td>
              <td><?= $datos->cantidad; ?></a></td>
              <td><?= $datos->valor; ?></a></td>
              <td><?= $datos->fecha; ?></a></td>
              <?php
                $fecha_ini=strtotime(date('Y-m-d'));
                $fecha_fin=strtotime($datos->fecha_notificacion);
                $dif=$fecha_fin-$fecha_ini;
                $dif = (( ( $dif / 60 ) / 60 ) / 24);
                if($dif<=3):
              ?>
                <td class="bg-info text-white font-weight-bold"><?= $datos->fecha_notificacion; ?></a></td>
              <?php else:?>
                <td><?= $datos->fecha_notificacion; ?></a></td>
              <?php endif;?>

              <td>
                <a href="<?=PROOT?>factura/editar/<?=$datos->id?>" class="btn btn-info btn-xs btn-sm">
                   Editar
                </a>
                <a href="<?=PROOT?>factura/eliminar/<?=$datos->id?>" class="btn btn-danger btn-xs btn-sm" onclick="if(!confirm('Desea eliminar este registro?')){return false;}">
                   Eliminar
                </a>
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