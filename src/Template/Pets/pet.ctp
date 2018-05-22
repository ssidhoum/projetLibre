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
    <div class="flexLayoutAccount">
        <div class="containerPets">
            <div class="layout1Pets">
                <?php
                    if (!empty($pet->photo)) {
                        $url= 'files/Pets/photo/april.jpg';

                        echo $this->Html->image($url, [
                            'height' => '120',
                            'width' => '120',
                            ]);
                }?>
                <div class="infoPets">
                    <?= h($pet->name)?> <br/>
                    suivi par: <?= h($pet->subscriptions_count)?> personnes <br/>
                    <?php
                        $birthday = new DateTime(h($pet->birthday));
                        echo $birthday->diff(new DateTime('now'))->y
                    ?> 
                    Ans / Inscrit depuis:
                    <?php  
                        $add= new DateTime(h($pet->created));
                        echo $add->diff(new DateTime('now'))->d
                    ?> jours <br/>
                    propriétaire:
                    <?= $pet->has('user') ? $this->Html->link($pet->user->firstname, ['controller' => 'Users', 'action' => 'view', $pet->user->id]) : '' ?>

                </div>
                <div>
                    <p>
                <!--nocache-->
                    <?php if ($pet->user_id == $this->request->session()->read('Auth.User.id')): ?>
                            <i class="fas fa-plus-circle"></i>
                            <?= $this->Html->link('Ajouter une photo', array('action' => 'edit', '?' => 'pet=' . $pet->id)); ?>
                    <?php else: ?>
                            <?php if(in_array($pet->id, $this->request->session()->read('Auth.Subscription'))) :?>

                                <i class="fas fa-times"></i>
                                <?= $this->Html->link('Se désabonner', array('controller' => 'pets', 'action' => 'unsubscribe', $pet->id)); ?>
                            <?php else: ?>
                                <i class="fas fa-check"></i>
                                <?= $this->Html->link('S\'abonner', array('controller' => 'pets', 'action' => 'subscribe', $pet->id)); ?>
                            
                            <?php endif; ?>
                    <?php endif ?>

                </p>
                </div>

            </div>
            <div class="layout2Pets">
                
                <table class="tablePets">
                    <tbody>
                    <?php foreach ($pet->posts as $posts): ?>
                        <tr>
                            <td>

                            <?php $url= 'files/Posts/photo/'.h($posts->photo);
                            echo $this->Html->image($url, [
                            'height' => '120',
                            'width' => '120',
                            'url' => ['controller' => 'posts', 'action' => 'view', h($posts->id)]
                            ]);?>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


