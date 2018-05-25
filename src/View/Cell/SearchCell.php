<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Search cell
 */
class SearchCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    
    public function display(){
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
