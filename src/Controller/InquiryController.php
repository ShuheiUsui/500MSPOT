<?php

namespace App\Controller;
use Cake\ORM\Entity;

class InquiryController extends AppController{

	public function initialize(){
		$this -> name = 'Inquiry';
		$this -> autoRender = true;
		$this -> viewBuilder() -> autoLayout(true);
	}

	public function index(){
	}

	public function comp(){

		//Model読み込み
		$this->loadModel('Informations');

		// timezoneをAsia/Tokyoに設定
		date_default_timezone_set('Asia/Tokyo');

		$info = array(
			'id' => NULL,
			'user_id' => '1', // とりあえず今は固定
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'datetime' => date("Y-m-d H:i"),
			'state' => '0',
			'admin_id' => '0'
		);

		//Entity作成
		$entity = $this->Informations->newEntity($info);

		//EntityをDBへ
		$this->Informations->save($entity);
		//確認用
		$this->set('entity',$entity);
	}
}
