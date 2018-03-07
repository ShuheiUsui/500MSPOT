<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Utils\Auth;

class MyPageController extends AppController{

	public function initialize(){
		$this->name = 'MyPage';
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
		$follows = 0;
		$followList = array(0);

		// Tableの取得
		$userTable = TableRegistry::get('Users');
		$followTable = TableRegistry::get('Follows');
		$articleTable = TableRegistry::get('Articles');

		// 自分がfollowしている人を取得
		$follows = $followTable->find()->where(['following =' => $userID]);

		foreach ($follows as $f) {
			$followList[] = $f->follower;
		}

		// 空じゃなければ
		if($followList != array()){
			$arts = $articleTable->find()->where(['articles.user_id IN' => $followList])->order(['datetime' => 'DESC']);
		}

		$this->set('arts', $arts);
	}
}
