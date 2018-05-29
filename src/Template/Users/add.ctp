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
    

    <div class="formAdd">
        <?= $this->Form->create($user) ?>


                  <table>
                <tr>
                    <td>
                        Votre adresse mail*
                    </td>
                    <td>
                        <?=  $this->Form->control('Users.email', ['label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Votre mot de passe*
                    </td>
                    <td>
                        <?=  $this->Form->control('Users.password',['label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Votre confirmation de mot de passe*
                    </td>
                    <td>
                        <?=  $this->Form->control('password2',['label' => ' ', 'type' => 'password']); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?= $this->Html->link(
                            'Mot de passe oublié?',
                            '/users/forgot',
                            ['class' => 'button', 'target' => '_blank']
                        ); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?= $this->Form->button(__('Inscription')) ?>
                    </td>
                </tr>
            </table>
            <?= $this->Form->end() ?>
    </div>
 </div>
