<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pet $pet
 */
?>

<div class="containerHome">
    <div class="navProfil">
            <nav class="cl-effect-13">
                <ul class="navAccount">
                    <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-home"></i>
                        <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                    </li>
                    <li<?php if($this->request->action == 'view'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-user-circle"></i>
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', $id)); ?>
                    </li>
                    <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-envelope"></i>
                        <?= $this->Html->link('Messagerie     '.$unreadcount, array('controller' => 'messages', 'action' => 'inbox')); ?>      
                    </li>
                    <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-cog"></i>
                        <?= $this->Html->link('Mes paramètres', array('controller' => 'users', 'action' => 'account')); ?>
                    </li>
                    <li<?php if($this->request->action === 'my'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-paw"></i>
                        <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
                    </li>
                    <li<?php if($this->request->action == 'edit'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-plus-circle"></i>
                        <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
                    </li>
                </ul>
            </nav>
    </div>
    <div class="flexLayoutAccount">
        <h2>
            Informations de : <?= $pet->name ?>
        </h2>
        <div class="infoAccount">
            <table class="tableAccount">
                <?= $this->Form->create($pet, ['type' => 'file']) ?>
                <tr>
                    <td>
                        <div class="pictureProfil">
                            <?php
                                if(empty($pet->photo)){
                                    if($pet->species_id == 1){
                                        $url= 'files/Pets/photo/chien.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);  
                                    }if($pet->species_id == 2){
                                        $url= 'files/Pets/photo/chat.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);
                                    }if($pet->species_id == 5){
                                        $url= 'files/Pets/photo/lapin.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);
                                    }
                                }else{
                                    $url= 'files/Pets/photo/'.$pet->photo;
                                    echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                    ]);
                                }
                            ?>
                        </div>
                    </td>
                    <td>
                        <?= $this->Form->input('photo', ['type' => 'file', 'label' => ' ']); ?>
                    </td>
                </tr>
                <tr >
                    <td class="ligneAccount">
                        Nom:  
                    </td>
                    <td class="ligneAccount">
                      <?= $this->Form->control('name', ['label' => ' ']); ?>  
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Espèce:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('species_id', ['options' => $species, 'label' => ' ']) ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Date de naissance:
                    </td>
                    <td class="ligneAccount">
                        <?php
                            echo $this->Form->date('birthday', [
                                'minYear' => 1960,
                                'maxYear' => 2018,
                                'monthNames' => false,
                                'empty' => [
                                'year' => 'année',
                                'month' => 'mois',
                                'day' => 'jour'
                            ],
        
                            'year' => [
                            'class' => 'cool-years',
                            'title' => 'Année dinscription'
                            ]
                            ]);
                        ?>

                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Race:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('race_id', ['options' => $races, 'label' => ' ']) ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Reproduction:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('reproduction_id', ['options' => $reproductions, 'label' => ' ']) ?>
                    </td>
                </tr>
                <tr class="hiddenTr">
                    <td>
                        <?= $this->Form->control('modified', ['disabled' => 'true', 'label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        <p>
                            Dernière modification: 
                            <?php  
                                $add= new DateTime(h($pet->modified));
                                echo $add->diff(new DateTime('now'))->d
                                ?> jours <br/>
                        </p>
                    </td>
                    <td class="ligneAccount">

                        <?= $this->Form->button('Valider', ['class' => 'btnAccount']); ?>
                    </td>
                </tr>

                
                <?= $this->Form->end() ?>
            </table>
        </div>
    </div>
</div>

