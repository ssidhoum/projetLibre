<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PetsPost Entity
 *
 * @property \App\Model\Entity\Pet $pet
 * @property \App\Model\Entity\Post $post
 */
class PetsPost extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'pet_id' => true,
        'post_id' => true,
        'pet' => true,
        'post' => true
    ];
}
