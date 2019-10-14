<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Users;
use Core\Router;
use Core\Session;
use Core\H;

class HomeController extends Controller {

	public function onConstruct(){
		$this->view->setLayout('index');
		$this->currentUser=Users::currentUser();
	}

	public function indexAction() {
        $this->view->user = $this->currentUser;
        if(isset($this->currentUser)){

	        if($this->currentUser->rol_id=='1'||$this->currentUser->rol_id=='2')
	      		Router::redirect('users/habilitar');
			else
				$this->view->render('home/index');
		}else{
      		Router::redirect('users/login');
		}
	}

	public function inactivoAction() {
		$this->view->setLayout('inactivo');
        $this->view->user = $this->currentUser;
		$this->view->render('home/inactivo');
	} 
}
