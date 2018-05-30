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
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', $idd)); ?>
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

    <div class="profilLayout">
        <div>
            <div class="profilContainer">
                <div class="actionProfil">
                    <?php if ($pet->user_id == $this->request->session()->read('Auth.User.id')): ?>
                        <i class="fas fa-plus-circle"></i>
                        <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
                    <?php else: ?>
                        <?php if(in_array($pet->id, $this->request->session()->read('Auth.Subscription'))) :?>
                            <i class="fas fa-times"></i>
                            <?= $this->Html->link('Se désabonner', array('controller' => 'pets', 'action' => 'unsubscribe', $pet->id)); ?>
                        <?php else: ?>
                            <i class="fas fa-check"></i>
                            <?= $this->Html->link('S\'abonner', array('controller' => 'pets', 'action' => 'subscribe', $pet->id)); ?>
                            
                        <?php endif; ?>
                    <?php endif ?>
                </div>
                
                <div class=picProfil>
                    <div class="picClassProfil">
                    <?php
                                if(empty($pet->photo)){
                                    if($pet->species_id == 1){
                                        $url= 'files/Pets/photo/chien.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);  
                                    }if($pet->species_id == 2){
                                        $url= 'files/Pets/photo/chat.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);
                                    }if($pet->species_id == 5){
                                        $url= 'files/Pets/photo/lapin.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);
                                    }
                                }else{
                                    $url= 'files/Pets/photo/'.$pet->photo;
                                    echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                    ]);
                                }
                    ?>
                    </div>
                </div>
                
                <div class="infoProfil">
                    <span>
                    <h2>
                        <?= h($pet->name)?>
                    </h2>
                    
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
                    <?= $pet->has('user') ? $this->Html->link($pet->user->firstname, ['controller' => 'Users', 'action' => 'view', $pet->user->id]) : '' ?> <br/>
                    reproduction:
                    <?= $pet->has('reproduction') ? $this->Html->link($pet->reproduction->name, ['controller' => 'Users', 'action' => 'view', $pet->user->id]) : '' ?>
                    <br/>
                    race:
                    <?= $pet->has('race') ? $this->Html->link($pet->race->name, ['controller' => 'Users', 'action' => 'view', $pet->user->id]) : '' ?> 
                    </span>
                </div>
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

