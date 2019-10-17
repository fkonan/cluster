<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Sectores;

class EnergiaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      //$datos = Sectores::find(['order'=>'sector']);
      //$this->view->datos = $datos;
      $this->view->render('energia/vis');
   }
	
	public function visAction(){
		$this->view->render('energia/vis');
	}

	public function tycAction(){
		$this->view->render('energia/tyc');
	}

	public function cysAction(){
		$this->view->render('energia/cys');
	}

	public function opAction(){
		$this->view->render('energia/op');
	}	

	public function ogAction(){
		$this->view->render('energia/og');
	}	
	
}