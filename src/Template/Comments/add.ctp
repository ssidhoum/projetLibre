<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="container">
    <div class="containerAccount">
    	<?= $this->Form->create($comment) ?>
    	<fieldset>
        <legend><?= __('Laisser un commentaire') ?></legend>
        <?php
            echo $this->Form->control('content', ['label' => 'votre commentaire: ','type' => 'textarea']);
            echo $this->Form->control('user_id', ['default' => $users, 'type'=>'text']);
            echo $this->Form->control('post_id', ['default' => $id, 'type'=>'text']);
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer commentaire')) ?>
    <?= $this->Form->end() ?>
    </div>
    <div class="menuAccount">
        <ul class="navAccount">
            <li>
				
            </li>
        </ul>
    </div>
</div>