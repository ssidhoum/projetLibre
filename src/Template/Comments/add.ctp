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
            echo $this->Form->control('post_id', ['default' => $id, 'type'=>'text', 'disabled' => 'true']);
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer commentaire')) ?>
    <?= $this->Form->end() ?>
    </div>
    <?php if ($this->request->session()->read('Auth.User')) :?>
        <div class="menuAccount">
            <ul class="navAccount">
                <li<?php if($this->request->action == 'add'): ?> class="active"<?php endif; ?>>
                    <i class="fas fa-plus-circle"></i>
                    <?= 
                        $this->Html->link(
                            'Ajouter commentaire',
                            '/'
                    );?>
                </li>
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
    <?php endif; ?>
</div>