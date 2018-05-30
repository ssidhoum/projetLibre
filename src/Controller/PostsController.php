<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;

class PostsController extends AppController
{


    public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['my','edit', 'add', 'like', 'unlike']);
    }

    /**
     * Edit method
     *
     */
    public function edit(){
        $pets=$this->Posts->Pets->find('list', array(
            'conditions'=> array('Pets.user_id'=>$this->Auth->user('id'))
        ));

        $user_id= $this->Auth->user('id');


        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());

            if ($this->Posts->save($post)){

                $this->Flash->success(__('Votre photo a bien été enregistrée.'));

                return $this->redirect(['action' => 'my']);
            }
            $this->Flash->error(__('Nous sommes désolée. Une erreur a été rencontrée. Réessayer, svp.'));
        }

        $this->loadModel('Pets');
        $own = $this->Pets->find('all', array(
            'conditions' => array('Pets.user_id' => $this->Auth->user("id")),
            'contain' => ['Species', 'Users']
        ));

        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));
         
        $unreadcount= $unread->count();
        
        $this->set(compact('pets','post', 'user_id', 'own', 'unreadcount'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $post = $this->Posts->get($id, [
            'contain' => ['Comments', 'Users']
        ]);

        $this->loadModel('Comments');
        $comment = $this->Comments->find('all', [
            'contain' => [ 'Users'],
            'conditions' => ['comments.post_id' => $post->id ]
        ]);

        $this->loadModel('Likes');
        $like = $this->Likes->find('all', [
            'contain' => [ 'Users'],
            'conditions' => ['likes.post_id' => $post->id ]
        ]);

        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));
         
        $user_id=$this->Auth->user('id');
        $unreadcount= $unread->count();

       
        $this->set(compact('comment', 'like', 'post', 'unreadcount', 'user_id'));
    }

    /**
     * Like method : allows to like a publication
     *
     */
    public function like($post_id){
        $firstSub = $this->Posts->Likes->newEntity();
        $firstSub->post_id = $post_id;
        $firstSub->user_id= $this->Auth->user("id");

        $conditions= array(
                'post_id'=>$post_id,
                'user_id'=>$this->Auth->user('id')
        );

        $this->loadModel('Likes');

        $count=$this->Likes->find('list', array(
            'conditions'=>$conditions
        ));

        if(!($count->isEmpty())){
            $this->Flash->error(__('Vous aimez déjà.'));
        }else{
            $this->Posts->Likes->save($firstSub);
            $this->request->session()->write("Auth.Like.$post_id", $post_id);
            $this->Flash->success(__("Merci pour votre j'aime."));
    
        }

        $this->redirect($this->referer());
    }

    /**
     * Unlike method : to dislike a publication
     *
     */
    public function unlike($post_id){
        $conditions= array(
                'post_id'=>$post_id,
                'user_id'=>$this->Auth->user('id')
        );

        $this->loadModel('Likes');
        $count=$this->Likes->find('list', array(
            'conditions'=>$conditions
        ));

        $this->request->session()->delete("Auth.Like.$post_id", $post_id);

        $this->Likes->deleteAll($conditions);
        $this->Flash->error(__('Merci pour votre je naime plus'));
        $this->redirect($this->referer());
    }

        

}