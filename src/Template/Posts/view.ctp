<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
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
    <?php endif ?>
        <div class="flexLayout">
            <div class="containerPost">
                <div class="post">
                    <?php $url= 'files/Posts/photo/'.h($post->photo);
                                echo $this->Html->image($url, [
                                    'class' => 'picPost'
                    ]);?>
                </div>
                <div class="infoPost">
                    <div class="titlePost">
                        <?= h($post->content);?>
                    </div>
                     
                    <table class="tablePost">
                        <tr>
                            <td>
                                publié le: <?= h($post->created);?>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            <?php if(in_array($post->id, $this->request->session()->read('Auth.Like'))) :?>
                                <i class="fas fa-times"></i>
                                <?= $this->Html->link("Je n'aime plus ", array('controller' => 'posts', 'action' => 'unlike', $post->id)); ?>
                            <?php else: ?>
                                <i class="fas fa-heart"></i>
                                <?= $this->Html->link("J'aime ", array('controller' => 'posts', 'action' => 'like', $post->id)); ?>
                            
                            <?php endif; ?>
                    
                            </td>
                            <td>
                                Aimé par :
                                <?php foreach ($like as $likes): ?>
                                    <?= $likes->has('user') ? $this->Html->link("   ".$likes->user->firstname, ['controller' => 'Users', 'action' => 'view', $likes->user->id]) : '' ?>
                                <?php endforeach ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-comment"></i>
                                <?= $this->Html->link("Je commente ", array('controller' => 'comments', 'action' => 'add', $post->id)); ?>
                            </td>
                            <td>
                                Les commentaires:
                            </td>
                        </tr>
                        <tr>
                            <?php foreach ($comment as $comments): ?>
                            <td>
                                <?= $comments->has('user') ? $this->Html->link("   ".$comments->user->firstname, ['controller' => 'Users', 'action' => 'view', $comments->user->id]) : '' ?>
                            </td>
                            <td>
                                <?= $comments->content ?>
                            </td>
                            <td>
                                le: <?= $comments->created ?>
                            </td>
                            <?php endforeach?>
                        </tr>

                    </table>

                </div>
            </div>
        </div>

    </div>
