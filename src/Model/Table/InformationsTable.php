<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class InformationsTable extends Table {
    public function initialize(array $config) {
        $this->belongsTo('users')->setForeignKey(['user_id']);

        $this->belongsTo('admins')->setForeignKey(['admin_id']);
    }
}
