<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Demandas;
use App\Models\DemandasEstados;
use App\Models\Users;
use App\Models\Sectores;
use App\Models\Modulos;
use App\Models\Empresas;
use App\Models\DemandasView;

class DemandasController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
      $this->currentUser=Users::currentUser();
   }

   public function indexAction(){
      $this->view->render('demandas/index');
   }

   public function listarDemandasAction(){
      $sectores= Sectores::find(['order'=>'sector']);
      $arr_sectores=[];

      foreach($sectores as $sectores){
         $arr_sectores[$sectores->id]=$sectores->sector;
      }
      $this->view->sectores = $arr_sectores;
      $this->view->render('demandas/listar_demandas');
   }

   public function buscarAction(){
      if($this->request->isPost()){
         $razon_social='%';
         $sector_id='%';

         if(!empty($this->request->get('razon_social')))
            $razon_social=$this->request->get('razon_social').'%';
         
         if(!empty($this->request->get('sector_id')))
            $sector_id=$this->request->get('sector_id');

         $datos=DemandasView::find([
            'conditions'=>'razon_social like ? and sector_id like  ? ',
            'bind'=>[$razon_social,$sector_id]
         ]);

         $resp = ['success'=>true,'datos'=>$datos];
         $this->jsonResponse($resp);

      }else{

         $razon_social='%';
         $sector_id='%';

         $datos=DemandasView::find([
            'conditions'=>'razon_social like ? and sector_id like ? ',
            'bind'=>[$razon_social,$sector_id]
         ]);

         $resp = ['success'=>true,'datos'=>$datos];
         $this->jsonResponse($resp);
      }
   }

   public function responderAction(){
      $datos = new DemandasEstados();
      if($this->request->isPost()){
         $this->request->csrfCheck();

         $datos->assign($this->request->get(),DemandasEstados::blackList);
         $datos->demanda_id=$this->request->get('id');
         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');

         if($datos->save()){
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }else{
         $demanda=Demandas::findById((int)$this->request->get('demanda_id'));
         $empresa=Empresas::findById((int)$demanda->empresa_id);

         $this->view->empresa = $empresa;
         $this->view->demanda = $demanda;
         $this->view->datos = $datos;
         $this->view->displayErrors = $datos->getErrorMessages();
         $this->view->postAction = PROOT . 'demandas' . DS . 'responder';
         $this->view->renderModal('demandas/responder');   
      }  
   } 

   public function nuevoAction(){
      $datos = new Demandas();
      if($this->request->isPost()){
         
         $this->request->csrfCheck();

         $datos->assign($this->request->get(),Demandas::blackList);
         if(!empty($this->currentUser->empresa_id)){
            $datos->empresa_id=$this->currentUser->empresa_id;
         }

         $datos->usuario_id=$this->currentUser->id;
         $datos->fecha_reg=date('Y-m-d H:m:s');

         if($datos->save()){
            $resp = ['success'=>true,'errors'=>$datos->getErrorMessages()];
         }
         else
            $resp = ['success'=>false,'errors'=>$datos->getErrorMessages()];

         $this->jsonResponse($resp);
      }else{
         
         $sectores= Sectores::find(['order'=>'sector']);
         $arr_sectores=[];

         foreach($sectores as $sectores){
            $arr_sectores[$sectores->id]=$sectores->sector;
         }

         $datos=new Demandas();

         $this->view->sectores = $arr_sectores;
         $this->view->datos = $datos;
         $this->view->displayErrors = $datos->getErrorMessages();
         $this->view->postAction = PROOT . 'demandas' . DS . 'nuevo';
         $this->view->renderModal('demandas/crear');   
      }
      
   }
}