<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public function isAuthorized($user)
{
    // Par défaut, on refuse l'accès.
    return false;
}


    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
        public function initialize(){
            $this->loadComponent('Flash');
            $this->loadComponent('Auth', [
            // La ligne suivante a été ajoutée
                'authorize'=> 'Controller',
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                        ]
                    ]
                ],
                'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
                ],
                'unauthorizedRedirect' => $this->referer()
            ]);
            $this->Auth->allow(['display', 'view', 'index']);
        }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if(isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin'){
            if($this->Auth->user('role') != 'admin'){
               throw new NotFoundException(__('Vous devez etre administrateur'));
                
            }
        }

        if($this->request->session()->read('Auth.User.id') && !$this->request->session()->read('Auth.Subscription')){

            $this->loadModel('Subscriptions');
            $query = $this->Subscriptions->find('list', [
            'keyField' => 'pet_id',
            'valueField' => 'pet_id'
            ])
            ->where([
            'user_id'=> $this->Auth->user("id")
            ]);
            $subscriptions = $query->toArray();
           

           $this->request->session()->write('Auth.Subscription',  $subscriptions);


        }







    }



}
