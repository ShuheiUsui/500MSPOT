<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Information;
use App\Model\Entity\User;
use App\Model\Entity\Admin;

class ManageController extends AppController{

	public function initialize(){
		$this -> name = 'Manage';
		$this -> autoRender = true;
		$this -> viewBuilder() -> autoLayout(true);
	}

	// Adminログインフォーム
	public function index(){

	}

	public function users(){

	}

	public function userDetail(){

	}

	// Admin/Informations
	public function Inquiries(){
		// Informationsテーブルの取得
		$informations = TableRegistry::get('Informations');
		$infoEntity = new Information;
		$userEntity = new User;
		$adminEntity = new Admin;
		$infos = array();

		//全件取得
		$query = $informations->find('all')->contain(['admins'])->contain(['users']);

		//Viewへ結果を渡す
		$this->set('query', $query);
	}

	// Admin/InfoDetail
	public function inquiryDetail(){
		if(!isset($_GET['id'])){
			// error
		}

		$id = $_GET['id'];
		// Informationsテーブルの取得
		$informations = TableRegistry::get('Informations');

		// Entity
		$infoEntity = new Information;
		$userEntity = new User;
		$adminEntity = new Admin;

		$detail = '';
		$info = array();

		$query = $informations->find()->where(['informations.id' => $id])->contain(['admins'])->contain(['users']);

		foreach ($query as $row) {
			//admin名
			$adminName = array(
				'lastName' => $row['admin']['last_name'],
				'firstName' => $row['admin']['first_name']
			);

			$infoEntity->set('info',$row);
			$userEntity->set('name',$row['user']['nickName']);
			$adminEntity->set('name', $adminName);

			$info = $infoEntity->get('info');
			$info['userName'] = $userEntity->get('name');
			$info['adminName'] = $adminEntity->get('name');
		}

		//Viewへ結果を渡す
		$this -> set('query', $query);
		$this -> set('info', $info);
	}

	public function reports(){

	}

	public function reportDetail(){

	}
}
