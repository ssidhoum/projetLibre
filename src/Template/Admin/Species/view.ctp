<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Species $species
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Modifier espèce'), ['action' => 'edit', $species->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer espèce'), ['action' => 'delete', $species->id], ['confirm' => __('Are you sure you want to delete # {0}?', $species->id)]) ?> </li>
        <li><?= $this->Html->link(__('Index espèce'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Ajouter une nouvelle espèce'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="species view large-9 medium-8 columns content">
    <h3><?= h($species->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($species->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($species->id) ?></td>
        </tr>
    </table>
</div>
