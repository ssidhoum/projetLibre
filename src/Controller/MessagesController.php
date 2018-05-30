<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;

/**
 * Messages Controller
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['inbox', 'outbox', 'compose', 'delete']);
    }

    /**
     * Inbox method: allows to see the messages that a user has received
     *
     */
    public function inbox() {
        $messages = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id' => $this->Auth->user('id')
            ),
            'order' => ['created' => 'DESC']

        ));
        $user= $this->Auth->user('id');
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));  
        $unreadcount= $unread->count();
        $this->set(compact('messages', 'user', 'unreadcount'));
    }

    /**
     * Outbox method: allows to see the messages that a user has sent
     *
     */
    public function outbox() {
        $messages = $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' => $this->Auth->user('id')
            ),
            'contain' => ['Users']
        ));
        $user= $this->Auth->user('id');
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));  
        $unreadcount= $unread->count();
        $this->set(compact('messages', 'unreadcount'));
    }

    /**
     * Compose method: allows to sent a message
     *
     */
    public function compose($recipient_id=null){
        $message = $this->Messages->newEntity();
        $message->sender_id = $this->Auth->user('id');
        if ($this->request->is('post', 'put')) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());

            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Votre message a bien été envoyé.'));

                return $this->redirect(['action' => 'outbox']);
            }
            $this->Flash->error(__('Problème rencontré lors denvoie du message'));
        }

        $sender_id  = $this->Auth->user('id');

        $archive1= $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' => $recipient_id,
                'recipient_id'=> $this->Auth->user('id')
            ),
            'contain' => [ 'Users'],
            'order' => ['Messages.created' => 'DESC']
        ));

        $archive= $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' =>  $this->Auth->user('id'),
                'recipient_id'=> $recipient_id
            ),
            'contain' => [ 'Users'],
            'order' => ['Messages.created' => 'DESC']
        ));

       $archive->unionAll($archive1); 
       $user= $this->Auth->user('id');
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));  
        $unreadcount= $unread->count();
        $this->set(compact('sender_id', 'message', 'recipient_id', 'archive', 'unreadcount'));
    }

    /**
     * View method
     *
     */
    public function view($id=null){
        $message= $this->Messages->get($id, [
            'contain' => ['Users']
        ]);

        $idUser= $this->Auth->user('id');
        $recipient_id= $message->sender_id;
        $date= $message->id;
       

        $archive1= $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' => $recipient_id,
                'recipient_id'=> $idUser,

            ),
            'contain' => [ 'Users'],

            
            


        ));

        $archives= $this->Messages->find('all', array(
            'conditions' => array(
                'sender_id' =>  $idUser,
                'recipient_id'=> $recipient_id,
                
            ),
            'contain' => [ 'Users'],
            
            
        ));

        $archives->unionAll($archive1)->order(['Messages.id' => 'DESC']);


        $message->status= 1;
        $this->Messages->save($message);



        $answer = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $answer = $this->Messages->patchEntity($answer, $this->request->getData());
            $answer->sender_id= $this->Auth->user('id');
            if ($this->Messages->save($answer)) {
                $this->Flash->success(__('Votre message a bien été envoyé.'));

                return $this->redirect(['action' => 'outbox']);
            }
            $this->Flash->error(__('Problème rencontré lors denvoie du message'));
        }

        $sender_idAnswer = $this->Auth->user('id');
        $recipient_idAnswer= $message->sender_id;
        $user= $this->Auth->user('id');
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));  
        $unreadcount= $unread->count();

        $this->set(compact('message', 'archives', 'sender_idAnswer', 'recipient_idAnswer', 'answer', 'unreadcount'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('La suppression a été prise en compte.'));
        } else {
            $this->Flash->error(__('Nous sommes désolée, nous avons rencontré une erreur. Merci de réessayer.'));
        }
        return $this->redirect(['action' => 'inbox']);
    }

}

