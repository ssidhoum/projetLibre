<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class PostsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setPrimaryKey('id', 'post_id');

        $this->belongsTo('Pets', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo' => [
               'fields' => [
                   'dir' => 'photo_dir',
               ],
                'path'=>'webroot{DS}img{DS}files{DS}{model}{DS}{field}{DS}',
           ],
       ]); 

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Comments', [
            'foreignKey'=>'post_id'
        ]);

        $this->hasMany('Petsposts', [
            'foreignKey'=>'post_id'
        ]);

        $this->hasMany('Likes', [
            'foreignKey'=>'post_id'
        ]);


        /*$this->belongsToMany('Pets', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'pet_id',
            'joinTable' => 'pets_posts'
        ]);*/
    }
}