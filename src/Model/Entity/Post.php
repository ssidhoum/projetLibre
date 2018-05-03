<?php

namespace App\Model\Entity;
use Cake\ORM\Entity;
use Cake\Collection\Collection;

class Post extends Entity{

    protected $_accessible = [
        'name' => true,
        'content' => true,
        'created' => true,
        'user_id' => true,
        'photo' => true,
        'photo_dir'=>true,
        'pet_id'=>true
    ];
    
}