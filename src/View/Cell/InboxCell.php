<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Inbox cell
 */
class InboxCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    	$this->loadModel('Messages');
    	$unread = $this->Messages->find('all', array(
            'conditions' => array(
                'status' => 0
            ),
        ));
        
        $this->set('unread_count', $unread->count());

    }
}
