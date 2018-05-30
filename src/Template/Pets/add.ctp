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
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', $users)); ?>
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

        <div class="flexLayout">
            <?= $this->Form->create($pet, ['type' => 'file']) ?>
            <h2>
                Ajouter un animal
            </h2>
            <table>

                <tr>
                    <td>
                        Nom:
                    </td>
                    <td>
                        <?= $this->Form->control('name', ['label'=>' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Espèce:
                    </td>
                    <td>
                        <?= $this->Form->control('species_id', ['options' => $species, 'label'=>' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Date de naissance:
                    </td>
                    <td>
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
                    <td>
                        Sexe:
                    </td>
                    <td>
                        <?= $this->Form->control('gender', ['label'=>' ', 'options'=>$genders ]); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Race:
                    </td>
                    <td>
                        <?= $this->Form->control('race', ['label'=>' ', 'options'=>$race ]); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Reprodution:
                    </td>
                    <td>
                        <?= $this->Form->control('reproduction', ['options' => $reproduction, 'label'=>' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Avatar:
                    </td>
                    <td>
                        <?= $this->Form->input('photo', ['type' => 'file']); ?>
                    </td>
                </tr>
                
                <tr class="hiddenTr">
                    <td> 
                        <?= $this->Form->control('user_id', ['default' => $users, 'type'=>'text']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <?= $this->Form->button(__('Ajouter')) ?>
                    </td>
                </tr>
            </table>
            <?= $this->Form->end() ?>
        </div>
</div>