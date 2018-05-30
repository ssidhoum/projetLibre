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
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', $users)); ?>
                    </li>
                    <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-cog"></i>
                        <?= $this->Html->link('Mes paramètres', array('controller' => 'users', 'action' => 'account')); ?>
                    </li>
                    <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-envelope"></i>
                        <?= $this->Html->link('Messagerie     '.$unreadcount, array('controller' => 'messages', 'action' => 'inbox')); ?>      
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
        <div class="flexLayout">
            <?= $this->Form->create($comment) ?>
            <h2>
                Ajouter un commentaire
            </h2>
            <table>
                <tr>
                    <td>
                        Votre commentaire:
                    </td>
                    <td>
                        <p class="lead emoji-picker-container">
                        <?php
                            echo $this->Form->control('content', ['label' => ' ','type' => 'textarea']); ?>
                        </p>
                    </td>
                </tr>
                <tr class="hiddenTr">
                    <td>
                        <?php 
                                echo $this->Form->control('user_id', ['default' => $users, 'type'=>'text']);
                        ?>
                    </td>
                </tr>
                <tr class="hiddenTr">
                    <td>
                        
                        <?php 
                                echo $this->Form->control('post_id', ['default' => $id, 'type'=>'text']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <?= $this->Form->button(__('Envoyer commentaire')) ?>
                    </td>
                </tr>
            </table>
            <?= $this->Form->end() ?>
        </div>
</div>