<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pet $pet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Species'), ['controller' => 'Species', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Species'), ['controller' => 'Species', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pets form large-9 medium-8 columns content">
    <?= $this->Form->create($pet, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Ajouter votre animal') ?></legend>
        <?php
            echo $this->Form->control('name', ['label'=>'Nom de votre animal:']);
 
            echo $this->Form->control('species_id', ['options' => $species, 'label'=>'Espèce de votre animal:']);
            echo $this->Form->control('birthday', ['label'=>'Date de naissance de votre animal:']);
            echo $this->Form->control('gender', ['placeholder'=>'femelle, mâle, autre', 'label'=>'Sexe de votre animal:']);

            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
