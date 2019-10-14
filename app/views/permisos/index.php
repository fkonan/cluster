<?php
use Core\FH;
use Core\H;
?>
<?php $this->setSiteTitle('Modulo Permisos')?>

<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/plugins/footable/footable.core.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card border-info">
   <div class="card-header text-center bg-success text-white">
      Edición de permisos por Rol
   </div>
   <div class="card-body pt-2">
	   
	   <?= FH::selectBlock('','cmb_rol','',$this->roles,['class'=>'form-control','placeHolder'=>'seleccione un Rol', 'onChange'=>'mostrarPermisosRol(this.value);'],['class'=>'col-md-4'],[], 'Seleccione un Rol...') ?>
	   </br>

		<div class="table-responsive">
			<form id='frmPermisos' name='frmPermisos' method='POST'>
				 <table class="table table-striped table-condensed table-bordered table-hover">
					<thead class="text-center">
					   <th class="col-auto bg-success">Estado</th>
					   <th class="col-auto bg-success">Modulo</th>
					</thead>
					<tbody id="div_PermisosRol">
							<tr>
								<td colspan="2" class="text-center">
									Debe seleccionar un Rol.
								</td>
							</tr>
					</tbody>
				 </table>
			</form>
		</div>
	
   </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/plugins/footable/footable.all.min.js"></script>
<script src="<?=PROOT?>js/footable/footableConfig.js"></script>
<script>

	function functionCheck(opt){
		
		if(opt=='todos'){
			$("#rd_ninguno").prop('checked', false);
			$("#rd_todos").prop('checked', true);
			cambiarEstadoChecks('todos');
		}else{
			$("#rd_todos").prop('checked', false);
			$("#rd_ninguno").prop('checked', true);
			cambiarEstadoChecks('ninguno');
		}
		
	}
	
	function cambiarEstadoChecks(opt='todos'){
		
		if(opt=='todos'){
			$("input[type=checkbox]").prop('checked', true);
			// crear todos los persmisos por modulo.

		}else{
			$("input[type=checkbox]").prop('checked', false);
			// Eliminar todos los permisos a modulos
		}
		
	}
	
	function actualizarPermiso(checkElement){
		
		rolId = $("#cmb_rol").val();
		modId = checkElement.value; //checked  name id value
		modEst = checkElement.checked;
		//alert('rolId: '+rolId+' - modId: '+modId);
		
		if(modEst) {  
            //alert("Activando");
			url = '<?=PROOT?>permisos/guardarPermiso/';
        } else {  
            //alert("Desactivando");
			url = '<?=PROOT?>permisos/eliminarPermiso/';
        }  
		
		jQuery.ajax({
			url : url,
			data:{
					rolId:rolId, 
					modId:modId,
			},
         	method : "POST",
			success : function(resp){
				//console.log(resp);
				//$("#div_PermisosRol").html(resp);
			}
		});
		
	}
	
	function mostrarPermisosRol(id){
		
		if($("#cmb_rol").val()!= ''){
		  
			jQuery.ajax({
				url : '<?=PROOT?>permisos/listarModulos/',
				data:{id:id},
				method : "GET",
				success : function(resp){
					//console.log(resp);
					$("#div_PermisosRol").html(resp);
				}
			});
			
		}else{
			$("#div_PermisosRol").html('<tr><td colspan="2" class="text-center">Debe seleccionar un Rol.</td></tr>');
		}
	}
	function actualizarPermisos(){
		
		rolId = $("#cmb_rol").val();
		var form = jQuery('#frmPermisos').serialize();
		
		//alert($('#frmPermisos input:checkbox[name=chk_1]:checked').val());
		//console.log($("#frmPermisos input").val());
		
		jQuery.ajax({
			url : '<?=PROOT?>permisos/guardarPermisos/'+rolId,
			method: "POST",
            data : form,
			success : function(resp){
				//console.log(resp);
				$("#div_PermisosRol").html(resp);
			}
		});
	}
     
</script>
<?php $this->end(); ?>