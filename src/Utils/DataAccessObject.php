<?php
namespace App\Utils;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Article;
use App\Model\Entity\Spot;
use App\Model\Entity\User;

/**
 * DataAccessObject
 * @author Shuhei Usui
 */
class DataAccessObject
{
	private $spotEntity;
	private $artEntity;
	private $userEntity;

	function __construct(){
		$this->spotEntity = new Spot;
		$this->artEntity = new Article;
		$this->userEntity = new User;
	}

	/***** Spot関連 *****/
	public function getNewSpots(){
	}

	// 特定スポット詳細を取得
	public function spotDetail($id){
		$spotTable = TableRegistry::get('Spots');
		$detail = '';

		// $spot = $spotTable->find()->where(['id =' => $id]);

		foreach ($spot as $row) {
			$this->spotEntity->set('spot', $row);
			$detail = $this->spotEntity;
		}
		return $detail;
	}


	/***** Article関連 *****/
	// 特定スポットの記事を取得
	public function spotArticles($id){
		$article = TableRegistry::get('Articles');

		$arts = array();

		$art = '';

		// foreach ($art as $row) {
		// 	$this->artEntity->set('article',$row);
		// 	$this->userEntity->set('name',$row['users']['nickname']);
		// 	$arts[] = array_merge($this->artEntity->get('article'), array('name' => $this->userEntity->get('name')));
		// }

		return $arts;
	}

	public function insertArticle($art){
		$flg = false;

		$articleTable = TableRegistry::get('Articles');
		if($articleTable->save($art)){
			$flg = true;
		}

		return $flg;
	}

	/***** User関連 *****/
	// 特定ユーザの投稿一覧取得
	public function userArticles($id){
		$arts = array();
		$user = TableRegistry::get('Users');

		$art = $user->find()->where(['users.id =' => $id])->contain(['Articles']);

		foreach ($art as $row) {

		}
		return $art;
	}

	// ユーザ登録
	public function createUser($user){
		$flg = false;

		$userTable = TableRegistry::get('Users');
		if($userTable->save($user)){
			$flg = true;
		}

		return $flg;
	}
}
