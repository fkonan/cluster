<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Sectores;

class AguaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      //$datos = Sectores::find(['order'=>'sector']);
      //$this->view->datos = $datos;
      $this->view->render('agua/vis');
   }
	
	public function visAction(){
		$this->view->render('agua/vis');
	}

	public function tycAction(){
		$this->view->render('agua/tyc');
	}

	public function cysAction(){
		$this->view->render('agua/cys');
	}

	public function opAction(){
		$this->view->render('agua/op');
	}	

	public function ogAction(){
		$this->view->render('agua/og');
	}	
	
}