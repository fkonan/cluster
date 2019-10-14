<?php
use Core\FH;
use Core\H;
?>
<div class="modal inmodal fade font-weight-bold" id="modalHabilitar" tabindex="-1" role="dialog" aria-labelledby="habilitarLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title text-decoration"><u>Habilitar Ussuario</u></h4>
         </div>
         <div class="modal-body">
            <form method="post" action="" id="frmHabilitar" role="form">
               <!--
               Datos del usuario
               -->
               <div class="row">
                  
                  <input type="hidden" name="id" id="id">

                  <?=FH::inputBlock('text','Nombre del usuario','nombre','',['class'=>'form-control','readOnly'=>true],['class'=>'col-md-6 form-group']);?>
                  
                  <?=FH::inputBlock('text','Correo electrónico','correo','',['class'=>'form-control','readOnly'=>true],['class'=>'col-md-6 form-group']);?>
               </div>
               <div class="row">
                  <?= FH::selectBlock('Asignar rol','rol_id','',$this->roles,['class'=>'form-control','placeHolder'=>'seleccione'],['class'=>'col-md-6 form-group']) ?>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="guardar();">Habilitar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

