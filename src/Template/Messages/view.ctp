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
        <div class="flexLayout">
            <div class="message">
                <h2>
                    Votre message:
                </h2>
                <div>
                    <table>
                        <?php foreach ($archives as $archive): ?>
                        
                            <?php if($archives->count() == 1) :?>
                                <p>
                                    Vous n'avez pas encore parlé
                                </p>
                            <?php else :?>
                                <tr>
                            <td>
                                <?= h($archive->id) ?>
                            </td>
                            <td>
                                DE : <?= h($archive->sender_id) ?> 

                            </td>
                            <td>
                                A: <?= h($archive->recipient_id) ?>
                                <?= $archive->has('user') ? $this->Html->link($archive->user->firstname, ['controller' => 'Users', 'action' => 'view', $archive->user->id]) : '' ?>
                            </td>
                            <td>
                                <?= h($archive->created->format('d/m/Y')) ?>
                            </td>
                            <td>
                                <?= h($archive->body) ?>
                            </td>
                        </tr>
                            <?php endif?>
                        <?php endforeach ?>
                    </table>
                </div>
                <div class="msgSelect">
                    <table>
                        
                            <td>
                                <tr>
                                     <h3><?= h($message->body) ?></h3>
                                </tr>
                                <tr>
                                    <?= h($message->created->format('d/m/Y')) ?>
                                </tr>
                            </td>
                        
                    </table>
                </div>
                <div class="answer">
            
                    <h2>
                        Votre réponse
                    </h2>
                    <?= $this->Form->create($answer) ?>
                    <table class="tableAnswer">
                    <tr class="hiddenTr">
                        <td>
                            Expéditeur
                        </td>
                        <td>
                            <?= $this->Form->control('sender_id', ['default' => $sender_idAnswer, 'type' => 'text', 'label' => ' ']);  ?>
                        </td>
                    </tr>
                    <tr class="hiddenTr">
                        <td>
                            Destinataire:
                        </td>
                        <td>
                            <?= $this->Form->control('recipient_id', ['default' => $recipient_idAnswer, 'type' => 'text', 'label' => ' ']);  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $this->Form->control('body', ['label' => ' ']);  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $this->Form->button('<i class="far fa-envelope"></i>Envoye', ['type' => 'submit', 'class' => 'sendBtn']); ?>
                        </td>                    </tr>
                    </table>
                    <?= $this->Form->end() ?>

                </div>
            </div>
            <div class="menuMessagerie">
                <nav class="cl-effect-13">
                    <ul class="navMessagerie">
                        <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                            <i class="fas fa-envelope"></i>
                            <?= $this->Html->link('Boite de reception', array('controller' => 'messages', 'action' => 'inbox')); ?>
                        </li>
                        <li<?php if($this->request->action == 'outbox'): ?> class="active"<?php endif; ?>>
                            <i class="fas fa-paper-plane"></i>
                            <?= $this->Html->link('Messages envoyés', array('controller' => 'messages', 'action' => 'outbox')); ?>
                        </li>
                        <li<?php if($this->request->action == 'compose'): ?> class="active"<?php endif; ?>>
                            <i class="fas fa-edit"></i>
                            <?= $this->Html->link('Rédiger un message', array('controller' => 'messages', 'action' => 'compose')); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
</div>

