<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use App\Utils\Auth;


class UserController extends AppController{

	public function initialize(){
		$this->name = 'User';
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
		}

		$this->set('login', $login);
	}

	public function index(){
		// 直リンクはエラー
		if(!isset($_GET['user_id'])){
			$this->redirect([
				'controller' => 'Error',
				'action' => 'index'
			]);
		}

		$user_id = $_GET['user_id'];
		$login_user = array();
		$user = '';
		$arts = '';
		$follow = false;
		$follower_users = array();
		$following_users = array();
		$followers = array();
		$followings = array();

		$userTable = TableRegistry::get('Users');
		$articleTable = TableRegistry::get('Articles');
		$followTable = TableRegistry::get('Follows');

		$user = $userTable->get($user_id);

		$arts = $articleTable->find()->where(['user_id =' => $user_id]);

		// 自分がフォローしているか確認
		if(isset($_SESSION['userInfo'])){
			$login_user = $_SESSION['userInfo'];
			$follow = $followTable->find()->where(['following =' => $login_user['id']])->where(['follower =' => $user->id]);
			if($follow->count() == 1){
				$follow = true;
			}else{
				$follow = false;
			}
		}


		// followされているユーザ
		$followers = $followTable->find()->where(['follower =' => $user_id]);
		if($followers->count() != 0){
			foreach ($followers as $row) {
				$follower_users[] = $row->following;
			}
			// var_dump($follower_users);
			$followers = $userTable->find()->where(['id IN' => $follower_users]);
		}

		// followしているユーザ
		$followings = $followTable->find()->where(['following =' => $user_id]);
		if($followings->count() != 0){
			foreach ($followings as $row) {
				$following_users[] = $row->follower;
			}
			$followings = $userTable->find()->where(['id IN' => $following_users]);
		}

		$this->set('user', $user);
		$this->set('arts', $arts);
		$this->set('follow', $follow);
		$this->set('followers', $followers);
		$this->set('followings', $followings);
	}

	public function follow() {
		$this->autoRender = false;

		$follower = $_POST['follower'];
		$following = $_SESSION['userInfo']['id'];

		$follow = array(
			'follower' => $follower,
			'following' => $following
		);

		$this->loadModel('Follows');
		$entity = $this->Follows->newEntity($follow);
		$this->Follows->save($entity);

		$this->response->body(json_encode($entity));
	}

	public function quitFollow() {
		$this->autoRender = false;
		$this->loadModel('Follows');

		$follower = $_POST['follower'];
		$following = $_SESSION['userInfo']['id'];

		$followTable = TableRegistry::get('Follows');



		$follow = $followTable->find()->where(['follower =' => $follower])->where(['following =' => $following]);
		foreach ($follow as $row) {
			$follow = $row;
		}

		$result = $this->Follows->delete($follow);

		$this->response->body(json_encode($follow));
	}
}
