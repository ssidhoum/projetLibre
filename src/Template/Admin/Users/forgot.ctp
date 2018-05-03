<div class="row">
	<div class="span12">
		 <?= $this->Form->create($user) ?>
		 <fieldset>
        <legend><?= __('Mot de passe oublié') ?></legend>
            <?php
                echo $this->Form->control('email');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Envoie mail')) ?>
        <?= $this->Form->end() ?>
	</div>
</div>
