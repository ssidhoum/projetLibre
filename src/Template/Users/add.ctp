<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Inscrivez-vous') ?></legend>
        <?php
            echo $this->Form->control('email', ['label' => 'votre adresse mail']);
            echo $this->Form->control('password',['label' => 'votre mot de passe']);
            echo $this->Form->control('password',['label' => 'confirmer votre mot de passe']);
            echo $this->Html->link(
                'Mot de passe oublié?',
                '/users/forgot',
                ['class' => 'button', 'target' => '_blank']
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Inscription')) ?>
    <?= $this->Form->end() ?>
</div>

