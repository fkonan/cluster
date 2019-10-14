<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Clientes;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Producto;

class FacturaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('default');
   }

   public function indexAction(){
      $datos = Factura::find([
         'columns'=>'factura.id,factura_no,nombre,telefono,celular,producto,cantidad,factura_detalle.valor,fecha,fecha_notificacion',
         'joins'=>
         [
            'joins'=>
            ['factura_detalle','factura.id=factura_detalle.factura_id','factura_detalle','INNER'],
            ['clientes','factura.cliente_id=clientes.id','clientes','INNER'],
            ['producto','factura_detalle.producto_id=producto.id','producto','INNER'],
         ],
         'order'=>'fecha_notificacion'
      ]);
      $this->view->datos = $datos;
      $this->view->render('factura/index');
   }

   public function nuevoAction(){
      $datos = new Factura();
      $factura_detalle = new FacturaDetalle();

      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get(),Factura::blackList);
         $datos->fecha=date('Y-m-d',strtotime($datos->fecha));
         $fecha_noti=date('Y-m-d',strtotime($datos->fecha.' +30 days'));
         $datos->fecha_notificacion=$fecha_noti;
         if($datos->save()){

            $factura_detalle->factura_id=$datos->id;
            $factura_detalle->producto_id=$this->request->get('producto_id');
            $factura_detalle->cantidad=$this->request->get('cantidad');
            $factura_detalle->valor=$this->request->get('valor');
            $factura_detalle->save();
            Session::addMsg('success','Registro guardado correctamente.');
            Router::redirect('factura');
         }
      }

      $clientes= Clientes::find(['order'=>'nombre']);
      $arr_clientes=[];
      foreach($clientes as $clientes){
         $arr_clientes[$clientes->id]=$clientes->nombre;
      }

      $productos= Producto::find(['order'=>'producto']);
      $arr_productos=[];
      foreach($productos as $productos){
         $arr_productos[$productos->id]=$productos->producto;
      }

      $this->view->clientes = $arr_clientes;
      $this->view->productos = $arr_productos;
      $this->view->datos = $datos;
      $this->view->factura_detalle = $factura_detalle;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'factura' . DS . 'nuevo';
      $this->view->render('factura/crear');
   }

   public function editarAction($id){
      $datos = Factura::findById((int)$id);
      $factura_detalle = FacturaDetalle::findFirst([
         'conditions'=>'factura_id = ? ',
         'bind'=>[(int)$id]
      ]);

      if(!$datos) Router::redirect('factura');

      if($this->request->isPost()){
         $this->request->csrfCheck();
         $datos->assign($this->request->get());
         $datos->fecha=date('Y-m-d',strtotime($datos->fecha));
         $fecha_noti=date('Y-m-d',strtotime($datos->fecha.' +30 days'));
         $datos->fecha_notificacion=$fecha_noti;

         if($datos->save()){
            $factura_detalle->producto_id=$this->request->get('producto_id');
            $factura_detalle->cantidad=$this->request->get('cantidad');
            $factura_detalle->valor=$this->request->get('valor');
            $factura_detalle->save();
            Router::redirect('factura');
         }
      }
      
      $clientes= Clientes::find(['order'=>'nombre']);
      $arr_clientes=[];
      foreach($clientes as $clientes){
         $arr_clientes[$clientes->id]=$clientes->nombre;
      }

      $productos= Producto::find(['order'=>'producto']);
      $arr_productos=[];
      foreach($productos as $productos){
         $arr_productos[$productos->id]=$productos->producto;
      }

      $this->view->clientes = $arr_clientes;
      $this->view->productos = $arr_productos;
      $this->view->datos = $datos;
      $this->view->factura_detalle = $factura_detalle;
      $this->view->displayErrors = $datos->getErrorMessages();
      $this->view->postAction = PROOT . 'factura' . DS . 'editar' . DS . $datos->id;
      $this->view->render('factura/editar');
   }

   public function eliminarAction($id){
      $datos = Factura::findById((int)$id);
      $factura_detalle = FacturaDetalle::findFirst([
         'conditions'=>'factura_id = ? ',
         'bind'=>[(int)$id]
      ]);

      if($datos){
         $datos->delete();
         $factura_detalle->delete();
         Session::addMsg('success','Registro eliminado correctamente.');
      }
      Router::redirect('factura');
   }

}