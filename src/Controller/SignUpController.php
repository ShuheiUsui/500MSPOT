<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;

class SignUpController extends AppController{

	public function initialize(){
		$this->name = 'SignUp';
		$this->autoRender = true;
		$this->viewBuilder() -> autoLayout(true);
	}

	public function index(){

	}

	public function execute(){
		// POSTされていないものがあればindexへ
		if(!isset($_POST['name']) || !isset($_POST['tel']) || !isset($_POST['address']) || !isset($_POST['password'])){
			$this->redirect([
				'controller' => 'Signup',
				'action' => 'index',
			]);
			return;
		}

		$user = array(
			'name' => $_POST['name'],
			'tel' => $_POST['tel'],
			'mailAddress' => $_POST['address'],
			'password' => hash('sha256', $_POST['password'])
		);

		$this->loadModel('Users');
		$entity = $this->Users->newEntity($user);

		$userTable = TableRegistry::get('Users');
		if($userTable->save($entity)){
			$flg = true;
		}

		if(!$flg){
			$this->redirect([
				'controller' => 'SignUp',
				'action' => 'index',
			]);
		}

		return;
	}
}
