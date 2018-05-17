<?php

namespace App\View\Cell;

use Cake\View\Cell;

class LoginCell extends Cell
{

    public function display()
    {
        $this->loadModel('User');
        $unread ='coucou';
        $this->set('unread');
    }

}