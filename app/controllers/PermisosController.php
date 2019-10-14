<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Permisos;
use App\Models\Roles;
use App\Models\Modulos;

class PermisosController extends Controller {

	public function onConstruct(){
	  $this->view->setLayout('index');
	}
	
	public function indexAction(){
		$datos = Permisos::find(['order'=>'id']);
		$this->view->datos = $datos;
		$this->view->roles=$this->listarRoles();
		$this->view->render('permisos/index');
		
	}
	
	private function listarRoles(){
		$roles= Roles::find(['order'=>'rol']);
		$arr_roles=[];

		foreach($roles as $roles){
		 $arr_roles[$roles->id]=$roles->rol;
		}
		//Quejesta mierda? es el vardump () die();
		//H::dnd($arr_roles);
			return $arr_roles;
	
	}
	
	public function listarModulosPorRol($rolId){
		return Permisos::buscarPermisosRol($rolId);
	}
	
	// Lista los modulos todos y checkea los activos por cada rol
	public function listarModulosAction($id){
		$id = $_GET["id"];
		// Clase estatica del modelo
		$obj_modulos = Modulos::buscarModulos();
		$resp = ['modulos'=>$obj_modulos];
		
		//Listado de modulos activos por rol
		$obj_ModulosPorRol = Modulos::buscarModulosRol($id);
		$respModRol = ['modulosRol'=>$obj_ModulosPorRol];
		//var_dump($respModRol);
		
        //$this->jsonResponse($resp);
		//var_dump($resp);
		$html = "";
		foreach($resp['modulos'] as $objModulo){
			
			//var_dump($resp);
			$estadoPermiso = 0;
			foreach($respModRol['modulosRol'] as $ObjRespModRol){
				if($objModulo->id==$ObjRespModRol->idModulo){
					$estadoPermiso+=1;
				}
			}
			if($estadoPermiso==0){
				$html.="<tr><td align='center'><input type='checkbox' onchange='actualizarPermiso(this);' id='chk_".$objModulo->id."' name='chk_".$objModulo->id."' value='".$objModulo->id."'></td><td align='center'>".$objModulo->modulo."</td></tr>";
			}else{
				$html.="<tr><td align='center'><input type='checkbox' onchange='actualizarPermiso(this);' id='chk_".$objModulo->id."' name='chk_".$objModulo->id."' value='".$objModulo->id."' checked></td><td align='center'>".$objModulo->modulo."</td></tr>";
			}
			
			
		}
		$html.="<tr>
					<td align='center'>
						
						
						<div class=\"form-check-inline\">
							<a href=\"#\" onClick=\"functionCheck('todos');\" style=\"text-decoration: none; color: black;\">
								<input type=\"radio\" class=\"form-check-input\" id=\"rd_todos\" name=\"optradio\" value=\"todos\" checked><strong>Todos</strong>
							</a>
						</div>
						<div class=\"form-check-inline\">
							<a href=\"#\" onClick=\"functionCheck('ninguno');\" style=\"text-decoration: none; color: black;\">
								<input type=\"radio\" class=\"form-check-input\" id=\"rd_ninguno\" name=\"optradio\" value=\"ninguno\"><strong>Ninguno</strong>
							</a>
						</div>
						
					</td>
					<td align='right'><a href='#' class='btn btn-success' onclick='location.reload();'>Actualizar Sitio</a></td>
				</tr>";
		echo $html;
		$html = "";
		
	}
	
	private function validaPermiso($idRol, $idModulo){
		$obj_RtaPermiso = Permisos::buscarPermiso($idRol, $idModulo);
		$resp = ['conteo'=>$obj_RtaPermiso];
		return $resp;
	}
	
	public function guardarPermisoAction($rolId="", $modId=""){
		
		//var_dump($_POST);
		if($rolId=="" || $modId==""){
			$rolId = $_POST["rolId"];
			$modId = $_POST["modId"];
		}
		
		$datos = new Permisos();
		// Pasa los datos del frm al modelo
		$datos->assign(['rol_id'=>$rolId, 'modulo_id'=>$modId],Permisos::blackList);
		if($datos->save())
			$resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
		else
			$resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

		unset($datos);
		return $resp;
		
	}

	
	public function eliminarPermisoAction($rolId="", $modId=""){
		
		//var_dump($_POST);
		if($rolId=="" || $modId==""){
			$rolId = $_POST["rolId"];
			$modId = $_POST["modId"];
		}

		$respPermiso = $this->validaPermiso($rolId, $modId);
		foreach($respPermiso['conteo'] as $objPermiso){
			
			if($objPermiso->rta>0){
				
				//echo 'se puede eliminar. '.$objPermiso->permisoID;
				$id=$objPermiso->permisoID;
				$datos = Permisos::findById((int)$id);
				if($datos){
					$datos->delete();
					$resp = ['success'=>true];
					return $this->jsonResponse($resp);
				}
				
			}
			
		}
		

	}
	
	public function guardarPermisosAction($rolId){
		//echo $rolId;
		//var_dump($_POST);
		//echo "</br></br>";
		$nroPermisosSinGuardar = 0;
		
		foreach($_POST as $nomControl => $idModulo){
		   //$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			
			$obj_EstadoPermiso = Permisos::buscarPermiso($rolId, $idModulo);
			$respPermiso = ['rta'=>$obj_EstadoPermiso];
			//var_dump($respPermiso);
			foreach($respPermiso['rta'] as $objPermiso){
				//echo "</br>ControlID: ".$nomControl." - Valor: ".$idModulo." - Estado: ".$objPermiso->rta."</br></br></br>";
				if($objPermiso->rta==0){
					$nroPermisosSinGuardar+=1;
					
					var_dump($this->guardarPermiso($rolId, $idModulo));
				}
				
				
			}
			
		}

	}
}