<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pet Entity
 *
 * @property int $id
 * @property string $name
 * @property int $species_id
 * @property \Cake\I18n\FrozenDate $birthday
 * @property \Cake\I18n\FrozenTime $created
 * @property string $gender
 * @property string $user_id
 *
 * @property \App\Model\Entity\Species $species
 * @property \App\Model\Entity\User $user
 */
class Pet extends Entity
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
        'name' => true,
        'species_id' => true,
        'birthday' => true,
        'created' => true,
        'gender' => true,
        'user_id' => true,
        'species' => true,
        'user' => true,
        'photo' => true,
        'photo_dir' => true,
        'pet_id' => true
    ];
}
