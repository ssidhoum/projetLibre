<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reproductions Model
 *
 * @method \App\Model\Entity\Reproductions get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reproductions newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reproductions[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reproductions|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reproductions patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reproductions[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reproductions findOrCreate($search, callable $callback = null, $options = [])
 */
class ReproductionsTable extends Table
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

        $this->setTable('reproductions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
