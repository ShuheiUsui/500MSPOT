<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class CommentsTable extends Table {
	public function initialize(array $config)
	{
		$this->belongsTo('users')->setForeignKey(['user_id']);
	}
}
