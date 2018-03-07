<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Utils\Auth;

class AccountController extends AppController{

	public function initialize(){
		$this->name = 'Account';
		$this->autoRender = true;
		$this->viewBuilder()->autoLayout(true);

		//login認証
		$login = array(
			'flg' => false,
			'user' => array()
		);

		$auth = new Auth();
		if($auth->checkLogin()){
			$login['flg'] = true;
			$login['user'] = $auth->getUserInfo();
			$this->set('login', $login);
		}else {
			$this->redirect([
				'controller' => 'Login',
				'action' => 'index',
				'?' => [
					'act' => 'MyPage'
				],
			]);
			return;
		}
	}

	// マイページ
	public function index(){
		// 非Login状態でも動いてしまうためSessionがない場合return
		if(!isset($_SESSION['userInfo'])){
			return;
		}

		$userID = $_SESSION['userInfo']['id'];
		$arts = array();

		// Tableの取得
		$userTable = TableRegistry::get('Users');
		// $followTable = TableRegistry::get('Follows');
		$articleTable = TableRegistry::get('Articles');

		// uesr情報の取得
		$user = $userTable->find()->where(['id =' => $userID])->first();

		$userArts = $articleTable->find()->where(['user_id =' => $userID]);

		$this->set('user', $user);
		$this->set('userArts', $userArts);
	}

	// プロフィール編集
	public function edit(){
		// 非Login状態でも動いてしまうためSessionがない場合return
		if(!isset($_SESSION['userInfo'])){
			return;
		}

		$user = '';
		$userID = $_SESSION['userInfo']['id'];
		$userTable = TableRegistry::get('Users');

		$user = $userTable->find()->where(['id =' => $userID])->first();

		$this->set('user', $user);
	}

	public function execute(){
		// 非Login状態でも動いてしまうためSessionがない場合return
		if(!isset($_SESSION['userInfo'])){
			return;
		}

		// 入力チェック(直リンク不可)
		if(!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['address'])){
			$this->redirect([
				'controller' => 'Error',
				'action' => 'index',
				'?' => [
					'code' => 'A001'
				]
			]);
			return;
		}

		$user = array(
			'id' => $_SESSION['userInfo']['id'],
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'mailAddress' => $_POST['address']
		);

		$userTable = TableRegistry::get('Users');

		$this->loadModel('Users');

		$entity = $this->Users->newEntity($user);
		$this->Users->save($entity);

		$this->redirect([
			'controller' => 'Account',
			'action' => 'index'
		]);
	}

}
