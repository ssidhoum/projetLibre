<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>

<div class="containerHome">
    <div class="navProfil">
        <nav>
            <ul class="navAccount">
                <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-home"></i>
                        <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                </li>
                <li<?php if($this->request->action == 'view'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-user-circle"></i>
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view')); ?>
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
        <?= $this->Form->create($post, ['type'=>'file']) ?>
        <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('content');
            echo $this->Form->control('user_id', ['options' => $users]);            
            echo $this->Form->input('photo', ['type' => 'file']);
            echo $this->Form->control('pets._ids', ['options' => $pets]);
        ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>