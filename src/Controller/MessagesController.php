<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{

    public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['inbox', 'outbox', 'compose']);
    }

    public function inbox() {
        $messages = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id' => $this->Auth->user('id')
            ),
            'order' => ['created' => 'DESC']

        ));


        $this->set(compact('messages'));
    }

    public function outbox() {
        $messages = $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' => $this->Auth->user('id')
            ),
            'contain' => ['Users']
        ));
        $this->set(compact('messages'));
    }

    public function compose($recipient_id=null){
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());

            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Votre message a bien été envoyé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Problème rencontré lors denvoie du message'));
        }
        $sender_id = $this->Auth->user('id');

        $archive1= $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' => $recipient_id,
                'recipient_id'=> $this->Auth->user('id')
            ),
            'contain' => [ 'Users']
        ));

        $archive= $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' =>  $this->Auth->user('id'),
                'recipient_id'=> $recipient_id
            ),
            'contain' => [ 'Users']
        ));

       $archive->unionAll($archive1);
        
        $this->set(compact('sender_id', 'message', 'recipient_id', 'archive'));
    }


    public function view($id){
        $message= $this->Messages->get($id, [
            'contain' => ['Users']
        ]);

        $message->status= 1;
        $this->Messages->save($message);
        $this->set(compact('message'));



    }

}

