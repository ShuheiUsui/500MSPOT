<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ArticlesTable extends Table {
	public function initialize(array $config) {
		// $this->belongsTo('spots')->setForeignKey(['spot_id']);
		$this->belongsTo('users')->setForeignKey(['user_id']);
		$this->hasMany('comments');
	}
}
