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
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', 3)); ?>
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
                        <?= $this->Form->control('birthday', ['label'=>' ']); ?>
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
                <tr class="hiddenTr">
                    <td> 
                        <?= $this->Form->control('user_id', ['options' => $users]); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $this->Form->button(__('Submit')) ?>
                    </td>
                </tr>
            </table>
            <?= $this->Form->end() ?>
        </div>
</div>