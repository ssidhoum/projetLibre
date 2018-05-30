<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\ArticlesTable|\Cake\ORM\Association\HasMany $Articles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');

        $this->setPrimaryKey('id', 'user_id');

        $this->addBehavior('Timestamp');
 

        $this->hasMany('Pets', [
            'foreignKey'=>'user_id'
        ]);

        $this->hasMany('Subscriptions', [
            'foreignKey'=>'user_id'
        ]);

        $this->hasMany('Likes', [
            'foreignKey'=>'user_id'
        ]);

        $this->hasMany('Comments', [
            'foreignKey'=>'user_id'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'avatar' => [
               'fields' => [
                   'dir' => 'avatar_dir',
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
        
        $validator->allowEmpty('avatar');

        $validator->requirePresence([
            'email' => [
            'mode' => 'create'
        ],
            'password' => [
            'mode' => 'create'
        ], 
            'password2' => [
            'mode' => 'create'
        ],
            'firstname' => [
            'mode' => 'update'
        ],
            'lastname' => [
            'mode' => 'update'
        ],
            'birthday' => [
            'mode' => 'update'
        ],
           
        ]);

        $validator->add('password2',[
            'match'=>[
                'rule'=> ['compareWith','password'],
                'message'=>'La confirmation est différente du mot de passe',
            ]
        ]);

        $validator->add('email', 'custom', [
            'rule' => [$this, 'isUnique'],
            'message' => __("Cet email est déjà utilisé.")
        ]);

        /**$validator
            ->add('avatarfile',[
                'isJpg'=>[
                    'rule'=>'isJpg',
                    'provider'=>'table',
                    'message'=>'Format accepté: jpg ou png'
                ]
            ]);**/

        return $validator;
    }


   /** public function isJpg($value,$context){
        $fieldname=$value['name'];
        if(empty($fieldname)){
            return true;
        }
        $info=pathinfo($fieldname);
        return ($info['extension'] == 'jpg');
    }


    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     

    public function buildRules(RulesChecker $rules)
    {
      ;

        $rules->add($rules->isUnique(['email']));
        
        return $rules;

    }
*/

    public function isUnique($data) {
        $query = $this->find('all')->where(['Users.email' => $data]);
        return $query->count() == 0;
    }
   


    
}
