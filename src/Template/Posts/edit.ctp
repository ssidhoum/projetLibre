<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="container">
    <div class="containerAccount">
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
    <div class="menuAccount">
        <ul class="navAccount">
            <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-cog"></i>
                <?= $this->Html->link('Mon compte', array('controller' => 'users', 'action' => 'account')); ?>
            </li>
            <li<?php if($this->request->action === 'my'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-cog"></i>
                <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
            </li>
            <li<?php if($this->request->action == 'edit'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-plus-circle"></i>
                <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
            </li>  
        </ul>
    </div>
</div>