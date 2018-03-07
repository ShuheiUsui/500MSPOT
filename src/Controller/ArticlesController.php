<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use App\Utils\Auth;

class ArticlesController extends AppController{

	public function initialize(){
		$this->name = 'Articles';
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
		// spotsテーブルの取得
		if(!isset($_GET['id'])){
			$this->redirect([
				'controller' => 'Home',
				'action' => 'index',
				'?' => [
					'action' => 'Post'
				],
			]);
		}

		$id = $_GET['id'];
		$arts = array();
		$cmtNum = 0;

		$articleTable = TableRegistry::get('Articles');
		$commentTable = TableRegistry::get('Comments');

		$arts = $articleTable->find()->where(['articles.id =' => $id])->contain('Users')->first();

		$comments = $commentTable->find()->where(['article_id =' => $id])->contain('Users');
		$cmtNum = $comments->count();

		$this->set('arts', $arts);
		$this->set('cmtNum', $cmtNum);
		if($cmtNum > 0){
			$this->set('comments', $comments);
		}

	}

	public function comment(){
		$this->autoRender = false;

		// 値がなければ処理しない
		if(!isset($_POST['article_id']) || !isset($_POST['comment'])){
			return;
		}

		$this->loadModel('Comments');

		$userInfo = $_SESSION['userInfo'];

		$comment = array(
			'article_id' => $_POST['article_id'],
			'user_id' => $userInfo['id'],
			'comment' => $_POST['comment'],
			'status' => 0
		);

		$entity = $this->Comments->newEntity($comment);
		$this->Comments->save($entity);

		// insert
		$this->response->body(json_encode($entity));
	}

	public function good(){
		$this->autoRender = false;

		// 値がなければ処理しない
		if(!isset($_POST['article_id'])){
			return;
		}

		$articleID = $_POST['article_id'];

		$articlesTable = TableRegistry::get('Articles');
		$article = $articlesTable->get($articleID);

		$article->good +=1;
		$articlesTable->save($article);

		$this->response->body(json_encode($article->good));
	}
}
