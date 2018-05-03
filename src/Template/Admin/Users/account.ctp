<div class="row">
    <div class="span8">
    <?=
    $this->Html->link(
        'Mes animaux',
        '/pets/my'
    );
    ?>

    </div> 
</div>

<div class="row">
	<div class="span8">
		<?= $this->Form->create($user, ['type' => 'file']) ?>
    	<fieldset>
        	<legend><?= __('Mon compte') ?></legend>
        	<?php

        		echo $this->Form->control('email', ['disabled' => 'true', 'label' => 'Votre adresse mail']);
        		echo $this->Form->control('created', ['disabled' => 'true', 'label' => 'Votre adresse mail']);
        		echo $this->Form->input('avatarf', ['type' => 'file', 'label' => 'Votre adresse mail']);
            	echo $this->Form->control('firstname',['label' => 'Votre prénom']);
            	echo $this->Form->control('lastname',['label' => 'Votre nom']);

			?>
    	</fieldset>
    	<?= $this->Form->button(__('Modifier vos informations')) ?>
    	<?= $this->Form->end() ?>
	</div>
	<div class="span4">

	</div>
</div>

