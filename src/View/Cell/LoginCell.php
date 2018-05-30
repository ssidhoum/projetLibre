<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Search cell
 */
class LoginCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    
    public function display(){
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
    
}
