<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use App\Models\Sectores;

class ArquitecturaController extends Controller {

   public function onConstruct(){
      $this->view->setLayout('index');
   }

   public function indexAction(){
      //$datos = Sectores::find(['order'=>'sector']);
      //$this->view->datos = $datos;
      $this->view->render('arquitectura/vis');
   }
	
	public function visAction(){
		$this->view->render('arquitectura/vis');
	}

	public function tycAction(){
		$this->view->render('arquitectura/tyc');
	}

	public function cysAction(){
		$this->view->render('arquitectura/cys');
	}

	public function opAction(){
		$this->view->render('arquitectura/op');
	}	

	public function ogAction(){
		$this->view->render('arquitectura/og');
	}	
	
}