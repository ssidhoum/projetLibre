<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\ORM\Entity;
use Cake\Mailer\Email;

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
    public function index(){
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
        $id=$this->Users->id=$this->Auth->user('id');
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));
         
        $unreadcount= $unread->count();
       
        $this->set(compact('follow', 'id', 'user', 'unreadcount'));
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
                $this->Flash->success(__('Votre inscription a réussi. Connectez-vous pour essayer.'));
                return $this->redirect(['action' => 'home']);
            }
            $this->Flash->error(__('Nous avons rencontré un soucis lors de votre inscription. Merci de réessayer.'));
        }
        $this->set('user', $user);   
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


    /**
    * Login method: allows a user to log in  
    *
    */
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

    /**
    * Logout method: allows a user to disconnect  
    *
    */
    public function logout(){
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect($this->Auth->logout());
    }

    /**
    * Forgot method: allows to generate a new password
    *
    */
    public function forgot(){
        if($this->request->is('post')){

            $search= $this->request->data('email');
            $query= '%'.$search.'%';

            
            $resultItems= $this->Users->find('all')->where(['Users.email LIKE' => $query]);

            if(empty($resultItems)){
                $this->Flash->error('Cet email est associé à aucun compte.Inscrivez vous :D.');
            }else{
                foreach ($resultItems as $items) {
                    $token= md5(uniqid().time());
                    $itemId= $items->id;
                    $itemEmail= $items->email;

                    if(!(empty($items->firstname))){
                        $itemFirstname= $items->firstname;
                    } else {
                        $itemFirstname = "Instapet-teur";
                    }


                    $email = new Email('default');
                    $email->from(['me@example.com' => 'My Site'])
                        ->viewVars(['token' => $token, 'user_id'=>$itemId])
                        ->to($itemEmail)
                        ->template('password')
                        ->subject('Rappel du mot de passe')
                        ->send("Bonjour".$itemFirstname.",</br> tu as besoin d'un coup de pouce?");

                    $this->Flash->success('Un mail vous a été envoyé pour regénerer votre mot de passe.');
                }
            }


            
        }else{
            $resultItems= "recherche";
        }

        $this->set('resultItems', $resultItems); 
    }

    /**
     * Account method: allows to modify the information of an account
     *
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
        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));
         
        $unreadcount= $unread->count();

            
            $this->set(compact('user', 'id', 'unreadcount'));       
    }

    /**
     * Home method : allows to generate the home page
     *
     */
    public function home(){
        if ($this->request->is('post')  && $this->request->data('email') && $this->request->data('password')) {
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

        if (!($follow->isEmpty()) ){
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
        }

        $id=$this->Users->id=$this->Auth->user('id');

        $firstname= $this->Auth->user('firstname');

        $this->set(compact('follow', 'lastPost', 'recentPets','id', 'firstname' ));


        $own = $this->Pets->find('all', array(
            'conditions' => array('Pets.user_id' => $this->Auth->user("id")),
            'contain' => ['Species', 'Users']
        ));
        $this->set(compact('own'));

        $this->loadModel('Messages');
        $unread = $this->Messages->find('all', array(
            'conditions' => array(
                'recipient_id'=> $this->Auth->user('id'),
                'status' => 0
            ),
        ));
         
        $unreadcount= $unread->count();
        $unread_count= $unreadcount;
        
        
        $this->set(compact('unread_count'));
    }



}
