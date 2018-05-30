<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;

class CommentsController extends AppController
{
	public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['logout', 'add', 'forgot', 'account', 'home']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
	public function add($id=null){
		echo $id;
        $comment = $this->Comments->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Votre commentaire a été envoyé .'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Nous sommes désolée lenvoie de votre commentaire a échoué. Merci de réessayer.'));
        }
		$users=$this->Auth->user('id');
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));  
        $user_id=$this->Auth->user('id');
        $unreadcount= $unread->count();
        $this->set(compact('comment', 'users', 'id', 'unreadcount'));
	}

    /**
     * View method
     *
     * @param string|null $id View id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $comment = $this->Comments->get($id, [
            'contain' => [ 'Users']
        ]);
        $this->set('comment', $comment);
    }


}