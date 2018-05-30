<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class  MessagesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Users', [
            'foreignKey' => 'sender_id',
        ]);    
    }

    public function validationDefault(Validator $validator){

        $validator->requirePresence([
            'body' => [
            'mode' => 'create'
        ],
            'recipient_id' => [
            'mode' => 'create'
        ] 
        ]);

        return $validator;

    }




}