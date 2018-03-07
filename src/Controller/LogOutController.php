<?php
namespace App\Controller;
use App\Utils\Auth;

class LogoutController extends AppController{

	public function initialize(){
		$this->name = 'Logout';
		$this->autoRender = true;
	}

	public function index(){

		$auth = new Auth();
		$auth->eraseSession();

		// HomeControllerへリダイレクト
		$this->redirect([
			'controller' => 'Home',
			'action' => 'index',
		]);
	}


}
