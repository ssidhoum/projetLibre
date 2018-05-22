<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
/**
 * Pets Controller
 *
 * @property \App\Model\Table\PetsTable $Pets
 *
 * @method \App\Model\Entity\Pet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PetsController extends AppController
{

    public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['my', 'add', 'edit', 'delete', 'pet', 'subscribe']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){
        $this->paginate = [
            'contain' => ['Species', 'Users']
        ];
        $pets = $this->paginate($this->Pets);

        $this->set(compact('pets'));
    }

    /**
     * View method
     *
     * @param string|null $id Pet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $pet = $this->Pets->get($id, [
            'contain' => ['Species', 'Users']
        ]);
        $this->set('pet', $pet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $pet = $this->Pets->newEntity();
        if ($this->request->is('post')) {
            $pet = $this->Pets->patchEntity($pet, $this->request->getData());

            if ($this->Pets->save($pet)) {
                $this->Flash->success(__('The pet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pet could not be saved. Please, try again.'));
        }
        $species = $this->Pets->Species->find('list', ['limit' => 200]);
        $genders = $this->Pets->Genders->find('list', ['limit' => 200]);
        $users = $this->Pets->Users->find('list', ['limit' => 200]);
        $this->set(compact('pet', 'species', 'users', 'genders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
        $pet = $this->Pets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pet = $this->Pets->patchEntity($pet, $this->request->getData());
            if ($this->Pets->save($pet)) {
                $this->Flash->success(__('The pet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pet could not be saved. Please, try again.'));
        }
        $species = $this->Pets->Species->find('list', ['limit' => 200]);
        $users = $this->Pets->Users->find('list', ['limit' => 200]);
        $this->set(compact('pet', 'species', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $pet = $this->Pets->get($id);
        if ($this->Pets->delete($pet)) {
            $this->Flash->success(__('The pet has been deleted.'));
        } else {
            $this->Flash->error(__('The pet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function my(){
        $pets = $this->Pets->find('all', array(
            'conditions' => array('Pets.user_id' => $this->Auth->user("id")),
            'contain' => ['Species', 'Users']
        ));
        $this->set(compact('pets'));
    }

    public function pet($id = null){
        $pet = $this->Pets->get($id, [
            'contain' => ['Posts', 'Species', 'Users']
        ]);
        $this->set('pet', $pet, $id);
    }

    public function subscribe($pet_id){

        $firstSub = $this->Pets->Subscriptions->newEntity();
        $firstSub->pet_id = $pet_id;
        $firstSub->user_id= $this->Auth->user("id");
        
        $this->Pets->Subscriptions->save($firstSub);
    }

    public function unsubscribe($pet_id){
        

    }

}
