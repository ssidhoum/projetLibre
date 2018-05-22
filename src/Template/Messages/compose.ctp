<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
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

        
            <h2>
                Envoyer un message
            </h2>
            
            <table>
                <?= $this->Form->create($message) ?>
                <tr>
                    <td>
                        Envoyeur:
                    </td>
                    <td>
                        <?= $this->Form->control('sender_id', ['default' => $sender_id, 'type' => 'text']);  ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Destinataire:
                    </td>
                    <td>
                        <?= $this->Form->control('recipient_id', ['default' => $recipient_id, 'type' => 'text']);  ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Votre message:
                    </td>
                    <td>
                        <?= $this->Form->control('body', ['label' => ' ']);  ?>
                    </td>
                </tr>
                <tr>
                    <?= $this->Form->button(__('Envoyer')) ?>
                </tr>
            </table>
            
            <?= $this->Form->end() ?>


            <table>
                <?php foreach ($archive as $archives): ?>
                    <tr>
                        <td>
                            De: <?= h($archives->sender_id) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            A: <?= h($archives->recipient_id) ?>
                            <?= $archives->has('user') ? $this->Html->link($archives->user->firstname, ['controller' => 'Users', 'action' => 'view', $archives->user->id]) : '' ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <?= h($archives->body) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

    
</div>