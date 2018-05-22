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
class UsersController extends AppController
{

    public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['logout', 'add', 'forgot', 'account', 'home']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Pets', 'Subscriptions'],
        ]);
        $this->loadModel('Subscriptions');
        $follow = $this->Subscriptions->find('all', [
            'contain' => ['Users','Pets'],
            'conditions' => ['Subscriptions.user_id' => $this->Auth->user('id') ]
         ]);
        $this->set('user', $user);
        $this->set(compact('follow'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre inscription a réussi :D :D .'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Nous sommes désolée votre inscription a échoué. Merci de réessayer.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('La suppression a été prise en compte.'));
        } else {
            $this->Flash->error(__('Nous sommes désolée, nous avons rencontré une erreur. Merci de réessayer.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function login(){
        if ($this->request->is('post')) {
        $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Super vous êtes connecté!.');
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }
    }

    public function logout(){
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect($this->Auth->logout());
    }

    /**
    *Permet de regénérer un mot de passe pour un utilisateur
    */
    public function forgot(){
        if(!empty($this->request->data)){
            $user= $this->Users->findByMail($this->request->date['User']['email'], array('id'));
            if(empty($user)){
                $this->Flash->error('Cet email est associé à aucun compte.Inscrivez vous :D.');
                debug($user);
            }
        }else{
            debug($user);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function account(){
        $id=$this->Users->id=$this->Auth->user('id');
        $user = $this->Users->findById($id)->firstOrFail();

            if ($this->request->is(['post', 'put'])) {
                $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                  
                    $this->Flash->success(__('Votre profil a été mis à jour.'));
                    return $this->redirect(['action' => 'account']);
                }
                $this->Flash->error(__('Impossible de mettre à jour votre profil.'));
            }


            $this->loadModel('Subscriptions');
            $follow = $this->Subscriptions->find('all', [
                    'contain' => ['Users','Pets'],
                    'conditions' => ['Subscriptions.user_id' => $this->Auth->user('id') ]
            ]);    

            $this->set('user', $user);
            $this->set(compact('follow' ));
    }

    public function home(){
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Super vous êtes connecté!.');
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }

        
        

        $this->loadModel('Pets');
        $recentPets = $this->Pets->find('all', [
        'limit' => 5,
        'order' => 'Pets.created DESC'
        ]);

        $this->loadModel('Subscriptions');
        $follow = $this->Subscriptions->find('all', [
            'contain' => ['Users','Pets'],
            'conditions' => ['Subscriptions.user_id' => $this->Auth->user('id') ]
         ]);

        $query = $this->Subscriptions->find('list', [
            'keyField' => 'pet_id',
            'valueField' => 'pet_id'
        ])
        ->where([
            'user_id'=> $this->Auth->user("id")
        ]);
        $pets_id = $query->toArray();
        
        $this->loadModel('Posts');
        $lastPost= $this->Posts->find('all',[
            'conditions' => ['pet_id IN' =>  $pets_id]
        ]);

        $this->set(compact('follow', 'lastPost', 'recentPets' ));
    }



}
