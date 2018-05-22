<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;

class PostsController extends AppController
{


    public function initialize(){   
        parent::initialize();
        // Ajoute l'action 'add' à la liste des actions autorisées.
        $this->Auth->allow(['my','edit', 'add', 'like', 'unlike']);
    }

    public function my(){
    }

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
        $this->set(compact('pets','post', 'user_id'));
    }

    public function view($id){
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

        $this->set('comment', $comment);
        $this->set('like', $like);
        
        $this->set('post', $post);
    }

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

    public function unlike($post_id){
        $conditions= array(
                'post_id'=>$post_id,
                'user_id'=>$this->Auth->user('id')
        );

        $this->loadModel('Likes');
        $count=$this->Likes->find('list', array(
            'conditions'=>$conditions
        ));

        $this->request->session()->delete("Auth.Like.$post_id");

        $this->Likes->deleteAll($conditions);
        $this->Flash->error(__('Merci pour votre je naime plus'));
        $this->redirect($this->referer());
    }

        

}