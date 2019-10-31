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
		
		//echo '<tr><td>Listado de todos los modulos: '.count($obj_modulos).'</td>';
		//echo '<td>Listado de modulos activos por rol: '.count($obj_ModulosPorRol).'</td></tr>';
		if(count($obj_ModulosPorRol)>0){
			$estadoCheckTodos = 'checked';
			$estadoCheckNinguno = ' ';
		}else{
			$estadoCheckTodos = ' ';
			$estadoCheckNinguno = 'checked';
		}
		
		$html.="<tr>
					<td align='center'>
						
						
						<div class=\"form-check-inline\">
							<a href=\"#\" onClick=\"functionCheck('todos');\" style=\"text-decoration: none; color: black;\">
								<input type=\"radio\" class=\"form-check-input\" id=\"rd_todos\" name=\"optradio\" value=\"todos\" ".$estadoCheckTodos."><strong>Todos</strong>
							</a>
						</div>
						<div class=\"form-check-inline\">
							<a href=\"#\" onClick=\"functionCheck('ninguno');\" style=\"text-decoration: none; color: black;\">
								<input type=\"radio\" class=\"form-check-input\" id=\"rd_ninguno\" name=\"optradio\" value=\"ninguno\" ".$estadoCheckNinguno."><strong>Ninguno</strong>
							</a>
						</div>
						
					</td>
					<td align='right'><a href='#' class='btn btn-success' onclick='location.reload();'>Actualizar Permisos</a></td>
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
		$contador = 0;
		
		if($rolId=="" || $modId==""){
			$rolId = $_POST["rolId"];
			$modId = $_POST["modId"];
		}
		
		

		if($modId=='todos'){

			$modulos = Modulos::find(['order'=>'id']);			
			//var_dump($modulos);
			
			foreach($modulos as $modulo){
				//echo 'IdMod: '.$modulo->id.' Modulo: '.$modulo->modulo;
			 	//$arr_modulos[$modulos->id]=$modulos->modulo;
				$permisosExistentes = Permisos::find([
					"conditions"=>"rol_id = '?' and  modulo_id = '?' ",
					"bind"=>[$rolId, $modulo->id]
				]);
				
				//var_dump($permisosExistentes);
				
				if(count($permisosExistentes)==0){
					
					$datos = new Permisos();
					$datos->assign(['rol_id'=>$rolId, 'modulo_id'=>$modulo->id],Permisos::blackList);

					if($datos->save()){
						$contador+=1;
						//echo 'IdMod: '.$modulo->id.' Modulo: '.$modulo->modulo;
					}else{
						$resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
					}
					unset($datos);
					
				}

				

			}
			
			//var_dump($datos);
			if($contador>=count($modulos)){
				$resp = ['success'=>true,'errors'=>'True'];
			}else{
				$resp = ['success'=>false,'errors'=>'Error al guardar todos.'];
			}
			
			//echo "Contador: ".$contador;
			$contador = 0;
			
		}else{
			$datos = new Permisos();
			$datos->assign(['rol_id'=>$rolId, 'modulo_id'=>$modId],Permisos::blackList);
			if($datos->save()){
				$resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
			}else{
				$resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
			}		
			
		}
				
		unset($datos);
		return $resp;
		
	}

	
	public function eliminarPermisoAction($rolId="", $modId=""){
		
		//var_dump($_POST);
		if($rolId=="" || $modId==""){
			$rolId = $_POST["rolId"];
			$modId = $_POST["modId"];
		}
		
		if($modId=='todos'){
			
			$permisos = Permisos::find([
				"conditions"=>"rol_id = ? ",
				"bind"=>[$rolId]
			]);


			foreach($permisos as $permiso){

				$id = $permiso->id;
				$datos = Permisos::findById((int)$id);
				if($datos){
					$datos->delete();
					//echo $id.' - ';
				}

			}			
			
			unset($datos);
			unset($permisos);
			
		}else{

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
			
			unset($datos);
			unset($respPermiso);
			unset($objPermiso);
			
		}
		
		

	}

	
	
	
	
	
}