<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
        <div class="containerProfil">
            <div class="layout1Profil">
                <h1 class="titleInfo">
                    <?= h($user->firstname);?>
                    <?= h($user->lastname); ?>
                </h1>
                <span>
                    <div class="pictureProfil">
                            <?php
                                if (empty($user->avatar)) {
                                        $url= 'files/Users/avatar/utilisateur3.png';
                                        echo $this->Html->image($url, [
                                            'height' => '120',
                                            'width' => '120',
                                        ]);
                                }else{
                                        $url= 'files/Users/avatar/'.$user->avatar;
                                        echo $this->Html->image($url, [
                                                'height' => '120',
                                                'width' => '120',
                                ]);
                            }?>
                    </div>
                </span>
                <?= $this->Html->link('Contacter', array('controller' => 'messages', 'action' => 'compose', $user->id)); ?>
            </div>
            <div class="layout2Profil">
                <h2>
                    Ses animaux:
                </h2>
                
                <?php foreach ($user->pets as $pets): ?>
                <table>
                    <tr>

                        <td>
                            <?php
                                if(empty($pets->photo)){
                                    if($pets->species_id == 1){
                                        $url= 'files/Pets/photo/chien.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);  
                                    }if($pets->species_id == 2){
                                        $url= 'files/Pets/photo/chat.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);
                                    }if($pets->species_id == 5){
                                        $url= 'files/Pets/photo/lapin.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        ]);
                                    }
                                }else{
                                    $url= 'files/Pets/photo/'.$pets->photo;
                                    echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                    ]);
                                }
                            ?> 
                        </td>

                        <td>
                            <?= h($pets->name) ?>
                        </td>

                        <td>
                            <?php
                            $birthday = new DateTime(h($pets->birthday));
                            echo $birthday->diff(new DateTime('now'))->y
                            ?> Ans
                        </td>
                        <td>
                            <?= $pets->has('species') ? $this->Html->link($pets->species->name, ['controller' => 'Species', 'action' => 'view', $pets->species->id]) : '' ?> 
                        </td>    
                    </tr>
                </table>
                <?php endforeach; ?>
                
            </div>

            <div class="layout3Profil">
                <h2>
                    Ses abonnements:
                </h2>
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach ($follow as $lastSign): ?>
                        <tr>
                            <td>
                                <div class="pictureProfil">
                                    <?php 
                                        if ($lastSign->has('pet')){
                                            $url= 'files/Pets/photo/'.$lastSign->pet->photo;
                                                echo $this->Html->image($url, [
                                                    'height' => '120',
                                                    'width' => '120',
                                                    'url' => ['controller' => 'Pets', 'action' => 'pet', $pets->id]
                                            ]);
                                        }
                                    ?>
                                </div>
                            </td>
                            <td>
                               <?= $lastSign->name; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table> 

            </div>
        </div>
        
    </div>
</div>
