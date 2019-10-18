<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;

class EmbendedController extends Controller {

	public function onConstruct(){
	  $this->view->setLayout('index');
	}

	public function indexAction(){
	  $this->view->render('embended/index');
	}

	public function archivoclimaticoAction(){
		$this->view->render('embended/ac');
	}

	public function climateConsultantAction(){
		$this->view->render('embended/climateconsultant');
	}

	public function parametrosAction(){
		$this->view->render('embended/parametros');
	}	
	
}