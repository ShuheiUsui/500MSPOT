<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use App\Utils\AppUtility;

class AdminController extends AppController{

	public function initialize(){
		$this->name = 'Admin';
		$this->autoRender = true;
		$this->viewBuilder()->autoLayout(true);
	}

	public function index(){

	}

	public function execute(){
		$this->autoRender = false;

		$this->redirect([
			'controller' => 'Manage',
			'action' => 'index',
		]);
		return;
	}

}
