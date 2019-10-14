<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\DatosObra;
use App\Models\Users;
use App\Models\Municipio;
use App\Models\TipoObra;
use App\Models\SubTipoObra;
use App\lib\utilities\Uploads;

class DatosObraController extends Controller {

	public function onConstruct(){
		$this->view->setLayout('index');
		$this->currentUser = Users::currentUser();
	}

	public function nuevoAction(){
	  	
	  	if($this->request->isPost()){
	  		
	  		$datos=new DatosObra();

	  		$datos->assign($this->request->get(),DatosObra::blackList);
  		 	
  		 	if(!$_FILES['licencia_construccion']['tmp_name'] == ''){

		  		$files['licencia_construccion'] = $_FILES['licencia_construccion'];
	            $uploads = new Uploads($files);
	            $uploads->runValidation();
	            $imagesErrors = $uploads->validates();

	            if(is_array($imagesErrors)){
	                $msg = "";
	                foreach($imagesErrors as $name => $message){
	                    $msg .= $message . " ";
	                }
	                $datos->addErrorMessage('licencia_construccion',trim($msg));
	            }
	        }

	        if(!$_FILES['licencia_demolicion']['tmp_name'] == ''){
		  		
		  		$files['licencia_demolicion'] = $_FILES['licencia_demolicion'];
	            $uploads = new Uploads($files);
	            $uploads->runValidation();
	            $imagesErrors = $uploads->validates();
	            
	            if(is_array($imagesErrors)){
	                $msg = "";
	                foreach($imagesErrors as $name => $message){
	                    $msg .= $message . " ";
	                }
	                $datos->addErrorMessage('licencia_demolicion',trim($msg));
	            }
	        }

	        if(!$_FILES['licencia_espacio_publico']['tmp_name'] == ''){
		  		
		  		$files['licencia_espacio_publico'] = $_FILES['licencia_espacio_publico'];
	            $uploads = new Uploads($files);
	            $uploads->runValidation();
	            $imagesErrors = $uploads->validates();
	            
	            if(is_array($imagesErrors)){
	                $msg = "";
	                foreach($imagesErrors as $name => $message){
	                    $msg .= $message . " ";
	                }
	                $datos->addErrorMessage('licencia_espacio_publico',trim($msg));
	            }
	        }

	        if(!$_FILES['programa_manejo_ambiental']['tmp_name'] == ''){
		  		
		  		$files['programa_manejo_ambiental'] = $_FILES['programa_manejo_ambiental'];
	            $uploads = new Uploads($files);
	            $uploads->runValidation();
	            $imagesErrors = $uploads->validates();
	            
	            if(is_array($imagesErrors)){
	                $msg = "";
	                foreach($imagesErrors as $name => $message){
	                    $msg .= $message . " ";
	                }
	                $datos->addErrorMessage('programa_manejo_ambiental',trim($msg));
	            }
	        }

	  		$gran_generador=0;

	  		if((int)$datos->area_obra>2000)
	  			$gran_generador=1;
	  		else
	  			$gran_generador=0;

	  		$datos->empresa_id=$this->currentUser->empresa_id;
	  		$datos->gran_generador=$gran_generador;
	  		$datos->usuario_id=$this->currentUser->id;
	  		$fecha_inicial=date('Y-m-d',strtotime($this->request->get('fecha_inicial')));
	  		$fecha_final=date('Y-m-d',strtotime($this->request->get('fecha_final')));
	  		$datos->fecha_inicial=$fecha_inicial;
	  		$datos->fecha_final=$fecha_final;
	  		$datos->fecha_reg=date('Y-m-d H:m:s');
	  		$datos->fecha_act=date('Y-m-d H:m:s');
  			/*
	  		if(!empty($this->request->get('fecha_inicial')))
	  		{
	  			$año=substr($this->request->get('fecha_inicial'),6);
	  			$mes=substr($this->request->get('fecha_inicial'),3,2);
	  			$dia=substr($this->request->get('fecha_inicial'),0,2);
	  			$fecha_inicial=$año.'-'.$mes.'-'.$dia;
	  			$datos->fecha_inicial=$fecha_inicial;
	  		}
			*/
	  		
			if(empty($datos->subtipo_obra_id)){
				$datos->subtipo_obra_id=null;
			}
			if(empty($datos->celular_responsable)){
				$datos->celular_responsable=null;
			}

	  		if($datos->save()){

	  			$datos=$datos->findById($datos->id);

	  			$path = 'documentos'.DS.'obra_'.$datos->id.DS;
	  			if(isset($uploads))
	  			{
			        foreach($uploads->getFiles() as $key=>$file){
			        	$parts = explode('.',$file['name']);
					    $ext = end($parts);
					    $uploadName = $key . '.' . $ext;
			          	$datos->$key = $path.$uploadName;
		          		$uploads->upload($path,$uploadName,$file['tmp_name']); 
			        }
		        	$datos->save();
		        }
	  			Router::redirect('materialesObra/nuevo');
	  		}else{
	  			H::dnd('error al guardar');
	  		}
	  	}else{
			
			$datos = new DatosObra();
		  	
		  	$muni= Municipio::find(['order'=>'municipio']);
		  	$arr_muni=[];
		  	foreach($muni as $muni){
		  		$arr_muni[$muni->id]=$muni->municipio;
		  	}

		  	$tipo_obra= TipoObra::find(['order'=>'tipo_obra']);
		  	$arr_tipo_obra=[];
		  	foreach($tipo_obra as $tipo_obra){
		  		$arr_tipo_obra[$tipo_obra->id]=$tipo_obra->tipo_obra;
		  	}

		  	$subtipo_obra= SubTipoObra::find(['order'=>'subtipo_obra']);
		  	$arr_subtipo_obra=[];
		  	foreach($subtipo_obra as $subtipo_obra){
		  		$arr_subtipo_obra[$subtipo_obra->id]=$subtipo_obra->subtipo_obra;
		  	}

		  	$datos->volumen=0;
		  	$datos->sotano=0;
		  	$this->view->municipio = $arr_muni;
		  	$this->view->tipo_obra = $arr_tipo_obra;
		  	$this->view->subtipo_obra = $arr_subtipo_obra;
		  	$this->view->datos = $datos;
		  	$this->view->postAction = PROOT . 'datosObra' . DS . 'nuevo';
		  	$this->view->render('datos_obra/crear');
		}
	}

	public function cargarSubtipoObraAction($tipo_obra){
		$subtipo=SubtipoObra::find([
			'conditions'=>'tipo_obra_id= ? ',
			'bind'=>[$tipo_obra]
		]);

		$arr_subtipo=[];

		foreach($subtipo as $subtipo){
			$arr_subtipo[$subtipo->id]=$subtipo->subtipo_obra;
		}

		$resp=['success'=>true,'subtipo'=>$arr_subtipo];
		$this->jsonResponse($resp);
	}

	public function cargarMaterialesAction($categoria){
		$material = CatMat::find([
			'columns'=>'material_id as id,material',
			'joins'=>
			[
				'joins'=>
				['materiales','cat_mat.material_id=materiales.id','materiales','INNER']
			],
			'conditions'=>'categoria_id=? ',
			'bind'=>[$categoria],
			'order'=>'material'
		]);
		$arr_material=[];

		foreach($material as $material){
			$arr_material[$material->id]=$material->material;
		}

		$resp=['success'=>true,'material'=>$arr_material];
		$this->jsonResponse($resp);
	}

	public function editarAction($id){
		$datos = DatosObra::findById((int)$id);

		if($this->request->isPost()){
			$this->request->csrfCheck();
			$datos->assign($this->request->get());
			$datos->generador_id=$this->currentUser->generador_id;
			$gran_generador='false';

			if((int)$datos->area_obra>2000)
				$gran_generador=1;
			else
				$gran_generador=0;

			$datos->gran_generador=$gran_generador;
			$datos->usuario_id=$this->currentUser->id;

			$año=substr($this->request->get('fecha_inicial'),6);
			$mes=substr($this->request->get('fecha_inicial'),3,2);
			$dia=substr($this->request->get('fecha_inicial'),0,2);
			$fecha_inicial=$año.'-'.$mes.'-'.$dia;

			$año=substr($this->request->get('fecha_final'),6);
			$mes=substr($this->request->get('fecha_final'),3,2);
			$dia=substr($this->request->get('fecha_final'),0,2);
			$fecha_final=$año.'-'.$mes.'-'.$dia;

			$datos->fecha_inicial=$fecha_inicial;
			$datos->fecha_final=$fecha_final;

			if($datos->save()){
				Session::addMsg('success','Obra actualizada correctamente');
				Router::redirect('datosObra');
			}else{
				$subtipo_obra_id=$this->request->get('subtipo_obra_id');
				$datos->subtipo_obra_id=$subtipo_obra_id;
			}
		}

		$muni= Municipio::find(['order'=>'municipio']);
		$arr_muni=[];
		foreach($muni as $muni){
			$arr_muni[$muni->id]=$muni->municipio;
		}

		$tipo_obra= TipoObra::find(['order'=>'tipo_obra']);
		$arr_tipo_obra=[];
		foreach($tipo_obra as $tipo_obra){
			$arr_tipo_obra[$tipo_obra->id]=$tipo_obra->tipo_obra;
		}

		$subtipo_obra= SubtipoObra::find(['order'=>'subtipo_obra']);
		$arr_subtipo_obra=[];
		foreach($subtipo_obra as $subtipo_obra){
			$arr_subtipo_obra[$subtipo_obra->id]=$subtipo_obra->subtipo_obra;
		}

		$año=substr($datos->fecha_inicial,0,4);
		$mes=substr($datos->fecha_inicial,5,2);
		$dia=substr($datos->fecha_inicial,8);
		$fecha_inicial=$dia.'/'.$mes.'/'.$año;

		$año=substr($datos->fecha_final,0,4);
		$mes=substr($datos->fecha_final,5,2);
		$dia=substr($datos->fecha_final,8);
		$fecha_final=$dia.'/'.$mes.'/'.$año;

		$datos->fecha_inicial=$fecha_inicial;
		$datos->fecha_final=$fecha_final;

		$this->view->municipio = $arr_muni;
		$this->view->tipo_obra = $arr_tipo_obra;
		$this->view->subtipo_obra = $arr_subtipo_obra;
		$this->view->datos = $datos;
		$this->view->displayErrors = $datos->getErrorMessages();
		$this->view->postAction = PROOT . 'datosObra' . DS . 'editar' . DS . $datos->id;

		$this->view->render('datos_obra/editar');
	}

	public function eliminarAction($id){
		$datos = DatosObra::findById((int)$id);
		if($datos){
			$registro_rcd=RegistroRcd::findFirst([
				'conditions'=>'obra_id=? ',
				'bind'=>[(int)$id]
			]);

			if($registro_rcd){
				Session::addMsg('danger','Esta obra ya contiene registro rcd, debe eliminarlo para continuar.');  
			}else{
				$datos->delete();
				Session::addMsg('success','Registro eliminado correctamente.');  
			}
		}
		Router::redirect('datosObra');
	}
}