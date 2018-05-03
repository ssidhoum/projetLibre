<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="row">
    <div class="span12">
        <h1>
            Editer une photo
        </h1>
    <?= $this->Form->create($post, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Ajouter votre animal') ?></legend>
        <?php
            echo $this->Form->control('name', ['label'=>'Titre photo:']);
            echo $this->Form->control('content', ['label'=>'légende:']);
            echo $this->Form->control('photo', ['type' => 'file']);
            echo $this->Form->control('pet_id', ['options' => $pets,'label'=>'Taguer animal:', 'multiple' ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Poster')) ?>
    <?= $this->Form->end() ?>
    </div>
</div>