<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Html->link(
                'Mot de passe oublié?',
                '/users/forgot',
                ['class' => 'button', 'target' => '_blank']
            ); ?>
<?= $this->Form->button('Connexion') ?>
<?= $this->Form->end() ?>