<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Utils\Auth;

class HomeController extends AppController{

	public function initialize(){
		$this->name = 'Home';
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

		$tags = array();
		$category = 0;
		$arts = array();

		$articleTable = TableRegistry::get('articles');


		if(isset($_GET['tags']) && isset($_GET['category'])){
			// CategoryとTagで絞り込み
			$tag = $_GET['tags'];
			$category = $_GET['category'];

			$tag = '%'.$tag.'%';

			$arts = $articleTable->find()->select(['id','good'])->where(['tags LIKE' => $tag])->where(['category_id =' => $category])->where(['report =' => 0])->order(['datetime' => 'DESC'])->limit(16);

		}else if(isset($_GET['tags'])){
			// Tagで絞り込み
			$tag = $_GET['tags'];

			$tag = '%'.$tag.'%';

			$arts = $articleTable->find()->select(['id','good'])->where(['tags LIKE' => $tag])->where(['report =' => 0])->order(['datetime' => 'DESC'])->limit(16);

		}else if(isset($_GET['category'])){
			// Categoryで絞り込み
			$category = $_GET['category'];

			$arts = $articleTable->find()->select(['id','good'])->where(['category_id =' => $category])->where(['report =' => 0])->order(['datetime' => 'DESC'])->limit(16);
		}else{
			// 絞り込み条件なし
			$popular = $articleTable->find()->select(['id','good'])->where(['report =' => 0])->order(['good' => 'DESC'])->limit(8);
			$arts = $articleTable->find()->select(['id','good'])->where(['report =' => 0])->order(['datetime' => 'DESC'])->limit(16);
		}

		$this->set('popular', $popular);
		$this->set('arts', $arts);
	}

}
