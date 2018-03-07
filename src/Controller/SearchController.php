<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Utils\Auth;

class SearchController extends AppController{

	public function initialize(){
		$this->name = 'Search';
		$this->autoRender = true;
		$this->viewBuilder() -> autoLayout(true);

		// login認証
		$login = false;

		$auth = new Auth();
		if($auth->checkLogin()){
			$login = true;
		}

		$this->set('login', $login);
	}

	public function index(){
		$articleTable = TableRegistry::get('articles');

		$arts = $articleTable->find()->select(['id','image','good'])->where(['report =' => 0])->order(['datetime' => 'DESC'])->limit(16);

		$this->set('arts', $arts);
	}

    // ajax 
	// public function more(){
	// 	$this->autoRender = false;
	// }

}
