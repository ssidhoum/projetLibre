<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;


class SubscriptionsController extends AppController
{

  public function initialize(){   
    parent::initialize();
    $this->Auth->allow(['view']);
  }

  /**
  * Add method
  */
  public function add(){
    
        $comment = $this->Subscriptions->newEntity();

            $comment = $this->Subscriptions->patchEntity($comment, $this->request->getData());
            
            $this->Subscriptions->save($comment);
          
          $users=$this->Auth->user('id');
        
        $this->set(compact('comment', 'users', 'id'));

  }

  /**
  * View method
  *
  * @param string|null $id Subscription id.
  * @return \Cake\Http\Response|void
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id=null){
    $user = $this->Subscriptions->get($id, [
            'contain' => ['Users','Pets'],
    ]);
    $this->set('user', $user);
  }





}
