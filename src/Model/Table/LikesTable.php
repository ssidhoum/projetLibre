<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class  LikesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
        ]); 

        $this->addBehavior('CounterCache', [
            'Posts' => ['like_count']
        ]);

        
    }




}