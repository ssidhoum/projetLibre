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

        
            <h2>
                Envoyer un message
            </h2>
           <div class="answer">
            
                    <h2>
                        Votre réponse
                    </h2>
                    <?= $this->Form->create($message) ?>
                    <table class="tableAnswer">
                    <tr>
                        <td>
                            Expéditeur
                        </td>
                        <td>
                            <?= $this->Form->control('sender_id ', ['default' => $sender_id   , 'type' => 'text', 'label' => ' ']);  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Destinataire:
                        </td>
                        <td>
                           <?= $this->Form->control('recipient_id', ['default' => $recipient_id , 'type' => 'text', 'label' => ' ']);  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            votre message:
                        </td>
                        <td>
                            <?= $this->Form->control('body', ['label' => ' ']);  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <?= $this->Form->button('<i class="far fa-envelope"></i>Envoye', ['type' => 'submit', 'class' => 'sendBtn']); ?>
                        </td>
                    </tr>
                    </table>
                    <?= $this->Form->end() ?>
            </div>
            

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