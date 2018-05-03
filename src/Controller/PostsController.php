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
        $this->Auth->allow(['my','edit', 'view']);
    }

    public function my(){
    }

    public function edit(){
        $pets=$this->Posts->Pets->find('list', array(
            'conditions'=> array('Pets.user_id'=>$this->Auth->user('id'))
        ));

        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());

            if ($this->Posts->save($post)){

                $this->Flash->success(__('Votre photo a bien été enregistrée.'));

                return $this->redirect(['action' => 'my']);
            }
            $this->Flash->error(__('Nous sommes désolée. Une erreur a été rencontrée. Réessayer, svp.'));
        }
        $this->set(compact('pets','post'));
    }

    public function view($id=null){
        /**$post = $this->Posts->get($id);
        $this->set('post', $post);**/

        $post = $this->Posts->get($id, [
            'contain' => ['Comments']
        ]);

        
        $this->set('post', $post);
    }
}