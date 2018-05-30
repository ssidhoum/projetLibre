<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="containerHome">
    <?php if ($this->request->session()->read('Auth.User')) :?>
        <div class="navProfil">
            <nav class="cl-effect-13">
                <ul class="navAccount">
                    <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-home"></i>
                        <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                    </li>
                    <li<?php if($this->request->action == 'view'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-user-circle"></i>
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', $user_id)); ?>
                    </li>
                    <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-envelope"></i>
                        <?= $this->Html->link('Messagerie     '.$unreadcount, array('controller' => 'messages', 'action' => 'inbox')); ?>      
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
    <?php endif ?>
        <div class="flexLayout">
            <div class="containerPost">
                <div class="post">
                    <?php $url= 'files/Posts/photo/'.h($post->photo);
                                echo $this->Html->image($url, [
                                    'class' => 'picPost'
                    ]);?>
                    <div class="titlePost">
                        <?= h($post->content);?> <br/>
                        publié le: <?= h($post->created->format('d/m/Y'));?>
                    </div>
                </div>

                <div class="infoPost">
                    <div class="actionsPost">
                        <div class="likeActionPost">
                            <i class="fas fa-heart"></i>
                                    <?= $this->Html->link("J'aime ", array('controller' => 'posts', 'action' => 'like', $post->id)); ?>
                        </div>
                        <div class="commentActionPost">
                            <i class="fas fa-comment"></i>
                            <?= $this->Html->link("Je commente ", array('controller' => 'comments', 'action' => 'add', $post->id)); ?>
                        </div>
                    </div>
                    <div class="commentPost">
                        <h3>
                            <i class="fas fa-comment"></i>
                            Commentaires:
                        </h3>
                        <table>
                            <?php foreach ($comment as $comments): ?>
                                <tr>
                                    <td>
                                        <?= $comments->has('user') ? $this->Html->link("   ".$comments->user->firstname, ['controller' => 'Users', 'action' => 'view', $comments->user->id]) : '' ?> : 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td class="alignRightTr">
                                        <?= $comments->content ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td class="alignRightTr">
                                        le: <?= $comments->created->format('d/m/Y') ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>

                </div>

                
            </div>
        </div>
</div>



























