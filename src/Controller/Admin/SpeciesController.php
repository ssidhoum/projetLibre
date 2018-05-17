<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Species Controller
 *
 * @property \App\Model\Table\SpeciesTable $Species
 *
 * @method \App\Model\Entity\Species[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SpeciesController extends AppController
{

public function initialize()
{   
    parent::initialize();
    // Ajoute l'action 'add' à la liste des actions autorisées.
    $this->Auth->allow(['add', 'edit']);
}



    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $species = $this->paginate($this->Species);

        $this->set(compact('species'));
    }

    /**
     * View method
     *
     * @param string|null $id Species id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $species = $this->Species->get($id, [
            'contain' => []
        ]);

        $this->set('species', $species);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $species = $this->Species->newEntity();
        if ($this->request->is('post')) {
            $species = $this->Species->patchEntity($species, $this->request->getData());
            if ($this->Species->save($species)) {
                $this->Flash->success(__('The species has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The species could not be saved. Please, try again.'));
        }
        $this->set(compact('species'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Species id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $species = $this->Species->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $species = $this->Species->patchEntity($species, $this->request->getData());
            if ($this->Species->save($species)) {
                $this->Flash->success(__('The species has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The species could not be saved. Please, try again.'));
        }
        $this->set(compact('species'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Species id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $species = $this->Species->get($id);
        if ($this->Species->delete($species)) {
            $this->Flash->success(__('The species has been deleted.'));
        } else {
            $this->Flash->error(__('The species could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function admin_index(){
        
    }





}
