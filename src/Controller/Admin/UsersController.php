<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

public function initialize()
{   
    parent::initialize();
    // Ajoute l'action 'add' à la liste des actions autorisées.
    $this->Auth->allow(['logout', 'add', 'forgot', 'account']);
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
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Articles']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre inscription a réussi :D :D .'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


public function login()
{
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



    public function account(){
        
        $id=$this->Users->id=$this->Auth->user('id');
        //$user = $this->Users->get($id);
        $user = $this->Users->findById($id)->firstOrFail();
            if ($this->request->is(['post', 'put'])) {
                $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {

                    

                    $this->Flash->success(__('Votre profil a été mis à jour.'));
                    return $this->redirect(['action' => 'account']);
                }
                $this->Flash->error(__('Impossible de mettre à jour votre profil.'));
                }
            $this->set('user', $user);
    }


}
