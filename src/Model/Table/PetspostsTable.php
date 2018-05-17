<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PetsPosts Model
 *
 * @property \App\Model\Table\PetsTable|\Cake\ORM\Association\BelongsTo $Pets
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 *
 * @method \App\Model\Entity\PetsPost get($primaryKey, $options = [])
 * @method \App\Model\Entity\PetsPost newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PetsPost[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PetsPost|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PetsPost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PetsPost[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PetsPost findOrCreate($search, callable $callback = null, $options = [])
 */
class PetspostsTable extends Table
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

        $this->setTable('Petsposts');
        $this->setDisplayField('id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
        ]);

        $this->belongsTo('Pets', [
            'foreignKey' => 'pet_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['pet_id'], 'Pets'));
        $rules->add($rules->existsIn(['post_id'], 'Posts'));

        return $rules;
    }
}
