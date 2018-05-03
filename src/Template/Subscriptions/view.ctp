<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users view large-9 medium-8 columns content">
    <h3> <?= h($user->id);?>
        <?= h($user->pet_id); ?>
        <?= $user->has('pet') ? $this->Html->link($user->pet->name, ['controller' => 'Species', 'action' => 'view', $user->pet->id]) : '' ?>
        <?= $user->has('user') ? $this->Html->link($user->user->firstname, ['controller' => 'Species', 'action' => 'view', $user->user->id]) : '' ?>
    </h3>
</div>
