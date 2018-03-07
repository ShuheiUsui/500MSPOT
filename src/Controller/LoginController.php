<?php
namespace App\Controller;
use App\Utils\Auth;

class LoginController extends AppController{

	public function initialize(){
		$this->name = 'Login';
		$this->autoRender = true;
		$this->viewBuilder() -> autoLayout(true);

		// login認証
		$login = false;

		$auth = new Auth();
		if($auth->checkLogin()){
			// $this->redirect([
			// 	'controller' => 'MyPage',
			// 	'action' => 'index'
			// ]);
			// return;
		}

		$this->set('login', $login);
	}

	public function index(){
	}

	public function execute(){

		// 不正アクセス
		if(!isset($_POST['mailaddress']) || !isset($_POST['password'])){
			$this->redirect([
				'controller' => 'Login',
				'action' => 'index',
			]);
			return;
		}

		$state = 0;
		$userInfo = array();
		$address = $_POST['mailaddress'];
		$password = $_POST['password'];

		$auth = new Auth();

		// ユーザ認証処理
		$login = $auth->userAuth($address, $password);

		if($login['flg']){
			// 認証処理
			$userInfo = $auth->getUserInfo();

			// print_r($userInfo);
			// return;
			$_SESSION['userInfo'] = array(
				'id' => $userInfo['id'],
				'name' => $userInfo['name']
			);

			// MyPageへリダイレクト
			$this->redirect([
				'controller' => 'Home',
				'action' => 'index',
			]);
		}else{
			if($login['miss']){
				$state = 1;
			}else if($login['empty']) {
				$state = 2;
			}

			//indexへリダイレクト
			$this->redirect([
				'controller' => 'Login',
				'action' => 'index',
				'?' => [
					'state' => $state
				],
			]);
		}
	}

}
