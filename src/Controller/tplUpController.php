<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Utils\DataAccessObject;

class ArticlesController extends AppController{

	public function initialize(){
		$this -> name = 'Articles';
		$this -> autoRender = true;
		$this -> viewBuilder() -> autoLayout(true);
	}

	public function index(){

	}
}
