<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class SpotsTable extends Table {
    public function initialize(array $config)
    {
        $this->hasMany('articles');
        $this->hasOne('users')->setForeignKey('user_id');
    }
}
