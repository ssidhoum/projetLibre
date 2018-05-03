<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class  SubscriptionsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);

        $this->belongsTo('Pets', [
            'foreignKey' => 'pet_id',
        ]); 

        $this->addBehavior('CounterCache', [
            'Pets' => ['subscriptions_count']
        ]);

        
    }




}