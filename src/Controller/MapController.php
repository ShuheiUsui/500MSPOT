<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Utils\Auth;

class MapController extends AppController{

	public function initialize(){
		$this -> name = 'Map';
		$this -> autoRender = true;
		$this -> viewBuilder() -> autoLayout(true);

		// login認証
		$login = false;

		$auth = new Auth();
		if($auth->checkLogin()){
			$login = true;
		}

		$this->set('login', $login);
	}

	public function index(){

	}

	public function near(){
		$this->autoRender = false;

		// $latlng = (float)$_POST['lat']+(float)$_POST['lng'];

		//半径500m
		$r = 0.004506;

		$articleTable = TableRegistry::get('articles');

		// $arts = $articleTable->find()->where(['lat+lng <' => $latlng + $r])->where(['lng+lng >' => $latlng - $r])->contain('Users');
		$arts = $articleTable
		->find()
		->where(['lat <' => $_POST['lat']+$r])
		->where(['lat >' => $_POST['lat']-$r])
		->where(['lng < ' => $_POST['lng']+$r])
		->where(['lng > ' => $_POST['lng']-$r])
		->contain('Users');
		// SELECT * FROM Articles WHERE lat < 35.693913 AND lat > 35.684901 AND lng < 139.704812 AND lng > 139.6958

		$this->response->body(json_encode($arts));
	}

	public function search(){
		$this->autoRender = false;

		if(!isset($_POST['length']) && !isset($_POST['category']) && !isset($_POST['postingDate']) ) {
			return;
		}

		$tag = '';
		$category = (int)$_POST['category'];
		$length = $_POST['length'];
		$postingDate = $_POST['postingDate'];

		$date = '';
		$arts = '';

		if(isset($_POST['tag']) && $_POST['tag'] != ''){
			$tag = '%'.$_POST['tag'].'%';
		}else {
			$tag = '';
		}

		switch ($postingDate) {
			case 0:
				$date = 0;
				break;

			case 7:
				$date = date("Y-m-d H:i:s",strtotime("-7 day"));
				break;

			case 14:
				$date = date("Y-m-d H:i:s",strtotime("-14 day"));
				break;

			case 30:
				$date = date("Y-m-d H:i:s",strtotime("-30 day"));
				break;

			case 60:
				$date = date("Y-m-d H:i:s",strtotime("-60 day"));
				break;
		}

		//フォームから取得
		$position = array(
			'lat' => $_POST['lat'],
			'lng' => $_POST['lng']
		);

		// フォームデータの整形
		$conditions = array(
			'tag' => $tag,
			'category' => $category,
			'length' => $length * 0.0009012,
			'postingDate' => $date
		);

		// var_dump($conditions);

		$articleTable = TableRegistry::get('articles');

		//キーワード && カテゴリ指定 && 投稿日指定 あり
		if ($conditions['tag'] != '' && $conditions['category'] != 0 && $conditions['postingDate'] != 0){

			$arts = $articleTable
			->find()
			->where(['category_id =' => $conditions['category']])
			->where(['tags LIKE' => $conditions['tag']])
			->where(['datetime >' => $conditions['postingDate']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		//キーワード && カテゴリ指定 あり
		else if($conditions['tag'] != '' && $conditions['category'] != '0'){

			$arts = $articleTable
			->find()
			->where(['category_id =' => $conditions['category']])
			->where(['tags LIKE' => $conditions['tag']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		//キーワード && 投稿日指定 あり
		else if($conditions['tag'] != '' && $conditions['postingDate'] != '0'){

			$arts = $articleTable
			->find()
			->where(['tags LIKE' => $conditions['tag']])
			->where(['datetime >' => $conditions['postingDate']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		//カテゴリ指定 && 投稿日指定 あり
		else if($conditions['category'] != 0 && $conditions['postingDate'] != 0){

			$arts = $articleTable
			->find()
			->where(['category_id =' => $conditions['category']])
			->where(['datetime >' => $conditions['postingDate']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		//キーワード あり
		else if($conditions['tag'] != ''){

			$arts = $articleTable
			->find()
			->where(['tags LIKE' => $conditions['tag']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		//カテゴリ指定 あり
		else if($conditions['category'] != ''){

			$arts = $articleTable
			->find()
			->where(['category_id =' => $conditions['category']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		//投稿日指定 あり
		else if($conditions['postingDate'] != ''){

			$arts = $articleTable
			->find()
			->where(['datetime >' => $conditions['postingDate']])
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}else{

			$arts = $articleTable
			->find()
			->where(['lat <' => $position['lat'] + $conditions['length']])
			->where(['lat >' => $position['lat'] - $conditions['length']])
			->where(['lng < ' => $position['lng'] + $conditions['length']])
			->where(['lng > ' => $position['lng'] - $conditions['length']])
			->contain('Users');
		}
		
		$this->response->body(json_encode($arts));
	}

}
