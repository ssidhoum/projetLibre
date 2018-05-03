<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]); 
    }
}