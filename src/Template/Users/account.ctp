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
                    <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-envelope"></i>
                        <?= $this->Html->link('Messagerie', array('controller' => 'messages', 'action' => 'inbox')); ?>
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
    <div class="flexLayoutAccount">
        <h1>
            Paramètres du compte:
        </h1>
        <div class="infoAccount">
            <table class="tableAccount">
                <?= $this->Form->create($user, ['type' => 'file']) ?>
                <tr>
                    <td>
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
                    </td>
                    <td>
                        <?= $this->Form->input('avatar', ['type' => 'file']); ?>
                    </td>
                </tr>
                <tr >
                    <td class="ligneAccount">
                      Prénom:  
                    </td>
                    <td class="ligneAccount">
                      <?=  $this->Form->control('firstname',['label' => ' ']); ?>  
                    </td>

                </tr>
                <tr>
                    <td class="ligneAccount">
                        Nom:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('lastname',['label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Adresse mail:
                    </td>
                    <td class="ligneAccount">
                        <?= $this->Form->control('email', ['disabled' => 'true', 'label' => ' ']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="ligneAccount">
                        Date de naissance:
                    </td>
                    <td class="ligneAccount">
                        <?php
                            echo $this->Form->date('birthday', [
                                'minYear' => 1960,
                                'maxYear' => 2018,
                                'monthNames' => false,
                                'empty' => [
                                'year' => 'année',
                                'month' => 'mois',
                                'day' => 'jour'
                            ],
        
                            'year' => [
                            'class' => 'cool-years',
                            'title' => 'Année dinscription'
                            ]
                            ]);
                        ?>

                    </td>
                </tr>
                <tr class="hiddenTr">

                    <td>
                        <?= $this->Form->control('modified', ['disabled' => 'true', 'label' => ' ']); ?>
                    </td>

                </tr>
                <tr>
                    <td class="ligneAccount">
                        <p>
                            Dernière modification: 
                            <?php  
                                $add= new DateTime(h($user->modified));
                                echo $add->diff(new DateTime('now'))->d
                                ?> jours <br/>
                        </p>
                    </td>
                    <td class="ligneAccount">

                        <?= $this->Form->button('Valider', ['class' => 'btnAccount']); ?>
                    </td>
                </tr>

                
                <?= $this->Form->end() ?>
            </table>
        </div>
    </div>
</div>

                        