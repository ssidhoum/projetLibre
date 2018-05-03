<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="container">
    <div class="containerAccount">
        <h1>
            Mon compte
        </h1>
        <h2>
            Changer vos informations
        </h2>
        <div class="containerInfo">
            <div class="pictureProfil">
            <?php
                if (empty($user->avatar)) {
                    $url= 'files/Users/avatar/utilisateur3.png';
                    echo $this->Html->image($url, [
                        'height' => '120',
                        'width' => '120',
                    ]);
            }else{
                $url= 'files/Users/avatar/'.$user->avatar;
                    echo $this->Html->image($url, [
                        'height' => '120',
                        'width' => '120',
                    ]);
            }?>
            </div>
            <div class="infoProfil">
                <?= $this->Form->create($user, ['type' => 'file']) ?>
                <fieldset> 
                    <?php
                        echo $this->Form->control('email', ['disabled' => 'true', 'label' => 'Votre adresse mail']);
                        echo $this->Form->control('created', ['disabled' => 'true', 'label' => 'Votre date d\'inscription']);
                        echo $this->Form->input('avatar', ['type' => 'file']);
                        echo $this->Form->control('firstname',['label' => 'Votre prénom']);
                        echo $this->Form->control('lastname',['label' => 'Votre nom']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Modifier vos informations')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
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
           -
        </ul>
    </div>
</div>