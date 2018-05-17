<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pets Model
 *
 * @property \App\Model\Table\SpeciesTable|\Cake\ORM\Association\BelongsTo $Species
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Pet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pet findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PetsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pets');
        $this->setDisplayField('name');

        $this->setPrimaryKey('id', 'pet_id');
       

        $this->addBehavior('Timestamp');

        $this->addBehavior('CounterCache', [
            'Pets' => ['subscriptions_count']
        ]);

        $this->hasMany('Subscriptions', [
            'foreignKey'=>'pet_id'
        ]);

        $this->hasMany('Posts', [
            'foreignKey'=>'pet_id'
        ]);

        $this->belongsTo('Species', [
            'foreignKey' => 'species_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]); 

        /**$this->belongsToMany('Posts', [
            'foreignKey' => 'pet_id',
            'targetForeignKey' => 'post_id',
            'joinTable' => 'pets_posts'
        ]);**/

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo' => [
               'fields' => [
                   'dir' => 'photo_dir',
               ],
                'path'=>'webroot{DS}img{DS}files{DS}{model}{DS}{field}{DS}',
           ],
       ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    
    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->date('birthday')
            ->requirePresence('birthday', 'create')
            ->notEmpty('birthday');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        return $validator;
    }


    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules){
        $rules->add($rules->existsIn(['species_id'], 'Species'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }




}
