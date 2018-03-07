<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use App\Utils\Auth;

class PostController extends AppController{

	public function initialize(){
		$this->name = 'Post';
		$this->autoRender = true;
		$this->viewBuilder()->autoLayout(true);

		//login認証
		$loginFlg = false;

		$auth = new Auth();
		if($auth->checkLogin()){
			$login = true;
			$userInfo = $auth->getUserInfo();
			$this->set('userInfo', $userInfo);
			$this->set('login', $login);
		}else{
			$this->redirect([
				'controller' => 'Login',
				'action' => 'index',
				'?' => [
					'state' => 'not_login'
				],
			]);
			return;
		}
	}


	public function index(){
	}

	public function execute(){
		// 入力チェック
		if($_FILES['article_image']['size'] === 0 || !isset($_POST['tags']) || !isset($_POST['lat']) || !isset($_POST['lng'])){
			$this->redirect([
				'controller' => 'Post',
				'action' => 'index',
				'?' => [
					'code' => 'PF001'
				],
			]);
			return;
		}

		$userInfo = $_SESSION['userInfo'];

		$this->loadModel('Articles');

		// 投稿完了フラグ
		$flg = true;

		$comment = '';

		// tagsの整形
		$tags = $_POST['tags'];
		$tags = str_replace(array(' ',' '), ',', $tags);

		// 記事の情報
		$article = array(
			'user_id' => $userInfo['id'],
			'category_id' => 1,	//要変更
			'lat' => $_POST['lat'],
			'lng' => $_POST['lng'],
			'content' =>  '',
			'image' => date("Y/m/d").'/'.$userInfo['id'].'/',
			'tags' => $tags,
			'good' => 0,
			'datetime' => date('Y-m-d H:i:s'),
			'report' => 0
		);

		// コメントの有無
		if(isset($_POST['comment'])){
			$article['comment'] = $_POST['comment'];
		}

		// imageを取得
		$articleImage = $_FILES['article_image'];

		// DBへINSERT
		$entity = $this->Articles->newEntity($article);
		$this->Articles->save($entity);

		$file = 'img/spot/'.$article['image'].$entity->id.'.jpg';

		// ディレクトリの存在確認
		if(!file_exists('img/spot/'.$article['image'])){
			//ディレクトリ作成
			mkdir('img/spot/'.$article['image'], 0777, true);
		}

		// アップロード
		if(!move_uploaded_file($_FILES['article_image']['tmp_name'], $file)){
			$flg = false;
		}

		$this->redirect([
			'controller' => 'Articles',
			'action' => 'index',
			'?' => [
				'id' => $entity->id
			],
		]);
		return;
	}

	public function edit(){
		// 直リンク
		if(!isset($_GET['id'])){
			$this->redirect([
				'controller' => 'Error',
				'action' => 'index',
				'?' => [
					'code' => 'Post/Edit:001'
				]
			]);
		}

		$user_id = $_SESSION['userInfo']['id'];

		$article_id = $_GET['id'];

		$art = TableRegistry::get('Articles')->find()->where(['id =' => $article_id])->where(['user_id =' => $user_id]);

		// 記事が見つからない場合 or 不正に編集しようとした
		if($art->count() == 0){
			$this->redirect([
				'controller' => 'Error',
				'action' => 'index',
				'?' => [
					'code' => 'Post/Edit:002'
				]
			]);
			return;
		}
		$art = $art->first();

		$this->set('art', $art);
	}

	public function editExecute(){
		// 入力チェック
		$this->autoRender = false;
		if(!isset($_POST['comment']) || !isset($_POST['tags'])){
			$this->redirect([
				'controller' => 'Post',
				'action' => 'index',
				'?' => [
					'code' => 'PF001'
				],
			]);
			return;
		}

		if(!isset($_SESSION['userInfo'])){
			return;
		}

		$userInfo = $_SESSION['userInfo'];

		$this->loadModel('Articles');

		// 投稿完了フラグ
		$flg = true;

		$article_id = $_POST['id'];
		$comment = $_POST['comment'];
		$tags = $_POST['tags'];

		// tagsの整形
		$tags = str_replace(array(' ',' '), ',', $tags);

		// 記事の情報
		$article = array(
			'id' => $article_id,
			'category_id' => '1',
			'content' => $comment,
			'tags' => $tags
		);

		// コメントの有無
		// if(isset($_POST['comment'])){
		// 	$article['comment'] = $_POST['comment'];
		// }

		// DBへUPDATE
		$entity = $this->Articles->newEntity($article);
		$this->Articles->save($entity);


		$this->redirect([
			'controller' => 'Articles',
			'action' => 'index',
			'?' => [
				'id' => $entity->id
			],
		]);
		return;
	}
}
