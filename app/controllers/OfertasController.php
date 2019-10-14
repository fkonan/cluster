<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Ofertas;
use App\Models\OfertasEstados;
use App\Models\Users;
use App\Models\Sectores;
use App\Models\Modulos;
use App\Models\Productos;
use App\Models\Empresas;
use App\Models\tipoOfertaAcademica;
use App\Models\ProductosView;
class OfertasController extends Controller {
   public function onConstruct(){
      $this->view->setLayout('index');
      $this->currentUser=Users::currentUser();
   }
   public function indexAction(){
      $this->view->render('ofertas/index');
   }
   public function listarOfertasAction(){
      
     $sectores= Sectores::find(['order'=>'sector']);
      $arr_sectores=[];
      foreach($sectores as $sectores){
         $arr_sectores[$sectores->id]=$sectores->sector;
      }
      $modulos= Modulos::find(['order'=>'modulo']);
      $arr_modulos=[];
      foreach($modulos as $modulos){
         $arr_modulos[$modulos->id]=$modulos->modulo;
      }
     
     $empresas = Empresas::find(['order'=>'razon_social']);
      $arr_empresas=[];
      foreach($empresas as $empresas){
         $arr_empresas[$empresas->id]=$empresas->razon_social;
      }
     
     $tipoOfertaAcademica = tipoOfertaAcademica::find(['order'=>'nom']);
      $arr_tipoOfertaAcademica=[];
      foreach($tipoOfertaAcademica as $tipoOfertaAcademica){
         $arr_tipoOfertaAcademica[$tipoOfertaAcademica->id]=$tipoOfertaAcademica->nom;
      }
      $this->view->modulos = $arr_modulos;
      $this->view->sectores = $arr_sectores;
     $this->view->tipoOfertaAcademica = $arr_tipoOfertaAcademica;
      $this->view->empresas = $arr_empresas;
      
     $this->view->render('ofertas/listar_ofertas');
   }
   public function buscarAction(){
     //echo "RS: ".$_POST['txtRazonSocial'].' / '.$this->request->get('txtRazonSocial');
      
      if($this->request->isPost()){
         $razon_social='%';
         $sector_id='%';
         $modulo_id='%';
         if(!empty($this->request->get('txt_razon_social')))
            $razon_social = '%'.$this->request->get('txt_razon_social').'%';
         
         if(!empty($this->request->get('cmb_sector_id')))
            $sector_id = '%'.$this->request->get('cmb_sector_id').'%';
         if(!empty($this->request->get('cmb_modulo_id')))
            $modulo_id = '%'.$this->request->get('cmb_modulo_id').'%';
         $datos=ProductosView::find([
            'conditions'=>'razon_social like ? and sector_id like  ?  and modulo_id like  ?',
            'bind'=>[$razon_social,$sector_id,$modulo_id]
         ]);
       
       $consulta = 'R.S: '.$razon_social.' / SectorID: '.$sector_id.' / modID: '.$modulo_id.' / POST: '.$this->request->isPost();  
         $resp = ['success'=>true,'datos'=>$datos, 'rs'=>$consulta];
       $this->jsonResponse($resp);
      }else{
         $razon_social='%';
         $sector_id='%';
         $modulo_id='%';
         $datos=ProductosView::find([
            'conditions'=>'razon_social like ? and sector_id like  ?  and modulo_id like  ?',
            'bind'=>[$razon_social,$sector_id,$modulo_id]
         ]);
         $resp = ['success'=>true,'datos'=>$datos, 'rs'=>'NO ES POST'];
         $this->jsonResponse($resp);
      }
     
      
   }
   public function nuevoAction(){
      $datos = new Ofertas();
      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get(),Ofertas::blackList);
         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');
         if($datos->save()){
            $estados=new OfertasEstados();
            $estados->oferta_id=$datos->id;
            $estados->estado=0;
            $estados->fecha_reg=date('Y-m-d H:m:s');
            $estados->save();
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];
         $this->jsonResponse($resp);
      }else{
         
         $producto=Productos::findById((int)$this->request->get('producto_id'));
         $empresa=Empresas::findById((int)$producto->empresa_id);
         $datos->producto_id=$producto->id;
         $this->view->producto = $producto;
         $this->view->empresa = $empresa;
         $this->view->datos = $datos;
         $this->view->displayErrors = $datos->getErrorMessages();
         $this->view->postAction = PROOT . 'ofertas' . DS . 'nuevo';
         $this->view->renderModal('ofertas/crear');   
      }
      
   }
   
   
}