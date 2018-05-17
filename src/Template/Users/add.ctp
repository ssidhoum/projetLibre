<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

 <div class="containerHome">
    <div class="containerLogo">
        <?=
                $this->Html->image("logo_V2.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
            ]);
            ?>
    </div>
    <div class="deco4">
        <?=
                $this->Html->image("balle.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
            ]);
        ?>
    </div>
    <div class="deco5">
        <?=
                $this->Html->image("ligne.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
            ]);
        ?>
    </div>

    <div class="formAdd">
        <?= $this->Form->create($user) ?>
        <fieldset>
        <legend><?= __('Inscrivez-vous') ?></legend>
        <?php
            echo $this->Form->control('email', ['label' => 'votre adresse mail']);
            echo $this->Form->control('password',['label' => 'votre mot de passe']);
            echo $this->Form->control('password',['label' => 'confirmer votre mot de passe']);
            echo $this->Html->link(
                'Mot de passe oublié?',
                '/users/forgot',
                ['class' => 'button', 'target' => '_blank']
            );
        ?>
        </fieldset>
            <?= $this->Form->button('Rejoignez notre communauté', ['class' => 'btnAdd']); ?>
            <?= $this->Form->end() ?>
    </div>
 </div>
