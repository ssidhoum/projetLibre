<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;

class SearchsController extends AppController
{

	public function initialize(){   
        parent::initialize();
        $this->Auth->allow(['search']);
    }

    /**
     * Search method
     *
     */
	public function search(){
		if($this->request->is('post')){
			$search= $this->request->data('name');
			$query= '%'.$search.'%';

			$this->loadModel('Pets');
			$resultItems= $this->Pets->find('all')->where(['Pets.name LIKE' => $query]);

			
		}else{
			$resultItems= "recherche";
		}

		$this->set('resultItems', $resultItems);
	}

}