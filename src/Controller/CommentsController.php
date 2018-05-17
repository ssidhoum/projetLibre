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


	public function add($id=null){
		
        $comment = $this->Comments->newEntity();
        if ($this->request->is(['post', 'put'])) {

            $comment = $this->Comments->patchEntity($comment, $this->request->getData());

            if ($this->Comments->save($comment)) {

                $this->Flash->success(__('Votre inscription a réussi :D :D .'));

                return $this->redirect(['action' => 'index']);

            }

            $this->Flash->error(__('Nous sommes désolée votre inscription a échoué. Merci de réessayer.'));
        }
		$users=$this->Auth->user('id');
        
        $this->set(compact('comment', 'users', 'id'));
	}

        public function view($id = null){
        $comment = $this->Comments->get($id, [
            'contain' => [ 'Users']
        ]);
        $this->set('comment', $comment);
    }


}