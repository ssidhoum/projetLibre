<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="containerHome">
    <div class="navProfil">
        <nav>
            <ul class="navAccount">
                <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-home"></i>
                        <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                </li>
                <li<?php if($this->request->action == 'view'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-user-circle"></i>
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view')); ?>
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
        <?= $this->Form->create($post, ['type' => 'file', 'class' => 'formPost']) ?>
        <table>
            <h1>
                <i class="fas fa-plus-circle"></i>
                Ajouter une publication
            </h1>

                <tr>
                    <td>
                        Titre de la photo:
                    </td>
                    <td>
                        <?= $this->Form->control('name', ['label'=>' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Légende:
                    </td>
                    <td>
                        <?= $this->Form->control('content', ['label'=>' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tag:
                    </td>
                    <td>
                        <?= $this->Form->control('pet_id', ['options' => $pets,'label'=>' ', 'multiple' ]); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Votre photo:
                    </td>
                    <td>
                        <?= $this->Form->input('photo', ['type' => 'file', 'label' => ' ']); ?>
                    </td>
                </tr>
                <tr class="hiddenTr">
                    <td>
                        Votre utilisateur:
                    </td>
                    <td>
                        <?= $this->Form->input('user_id', ['default' => $user_id, 'type'=>'text', 'label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                       <?= $this->Form->button('Poster', ['class' => 'btnAccount']); ?>
                    </td>
                </tr>
            
            <?= $this->Form->end() ?>
        </table>
    </div>
</div>