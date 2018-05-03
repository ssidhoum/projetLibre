<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;


class SubscriptionsController extends AppController
{

  public function initialize(){   
    parent::initialize();
    $this->Auth->allow(['logout', 'add', 'forgot', 'account', 'home']);
  }

  public function add($id=null){
    
        $comment = $this->Subscriptions->newEntity();

            $comment = $this->Subscriptions->patchEntity($comment, $this->request->getData());
            
            $this->Subscriptions->save($comment);
          
          $users=$this->Auth->user('id');
        
        $this->set(compact('comment', 'users', 'id'));

  }

  public function view($id){
    $user = $this->Subscriptions->get($id, [
            'contain' => ['Users','Pets'],
    ]);
    $this->set('user', $user);

  }





}
