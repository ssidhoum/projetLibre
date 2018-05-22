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
                        <?php
                            echo $this->Form->control('content', ['label' => ' ','type' => 'textarea']); ?>
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
                            echo $this->Form->control('post_id', ['default' => $id, 'type'=>'text', 'disabled' => 'true']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $this->Form->button(__('Envoyer commentaire')) ?>
                    </td>
                </tr>
            </table>
            <?= $this->Form->end() ?>
        </div>
</div>