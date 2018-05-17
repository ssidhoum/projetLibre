<?php
/**
 * @var \App\View\AppView $this
 */
?>



<div class="containerHome">
    <div class="navProfil">
            <nav class="cl-effect-13">
                <ul class="navAccount">
                    <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-home"></i>
                        <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                    </li>
                    <li<?php if($this->request->action == 'view'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-user-circle"></i>
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', 3)); ?>
                    </li>
                    <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-cog"></i>
                        <?= $this->Html->link('Mes paramètres', array('controller' => 'users', 'action' => 'account')); ?>
                    </li>
                    <li<?php if($this->request->action === 'my'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-paw"></i>
                        <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
                    </li>
                    <li<?php if($this->request->action == 'edit'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-plus-circle"></i>
                        <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
                    </li>
                </ul>
            </nav>
    </div>
    <div class="flexLayoutAccount">
        <h1>
            Paramètres du compte:
        </h1>
        <div class="infoAccount">
            <table class="tableAccount">
                <?= $this->Form->create($user, ['type' => 'file']) ?>
                <tr >
                    <td class="ligneAccount">
                      Nom:  
                    </td>
                    <td class="ligneAccount">
                      <?=  $this->Form->control('firstname',['label' => ' ']); ?>  
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Prénom:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('lastname',['label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Adresse mail:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('email', ['disabled' => 'true', 'label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Date de naissance:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('lastname',['label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                    
                    </td>
                    <td class="ligneAccount">

                        <?= $this->Form->button('Valider', ['class' => 'btnAccount']); ?>
                    </td>
                </tr>

                
                <?= $this->Form->end() ?>
            </table>
        </div>
    </div>
</div>

                        