<div class="containerHome">
        <div class="flexLayout">
            <h1 class="titleAccount">
                Votre compte
            </h1>
            <h2 class="titleAccount">
                Modifier vos paramètres
            </h2>
            <div class="deco7">
                <?=
                $this->Html->image("ligne2.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                ?>
            </div>
            <div class="containerAccount">
                    <div class="pictureProfilAccount">

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
                    </div>
                    <div class="formAccount">
                        <?= $this->Form->create($user, ['type' => 'file']) ?>
                        <?php echo $this->Form->control('firstname',['label' => 'Votre prénom']); ?>
                        <?php echo $this->Form->control('lastname',['label' => 'Votre nom']); ?>
                        <?php echo $this->Form->control('email', ['disabled' => 'true', 'label' => 'Votre adresse mail']); ?>
                        <?php echo $this->Form->input('avatar', ['type' => 'file']); ?>
                        <?= $this->Form->button(__('Modifier vos informations')) ?>
                        <?= $this->Form->end() ?>
                    </div>
            </div>
            <div class="decoMenu2">
                 <?=
                $this->Html->image("deco6.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                ?>
            </div>

                
        </div>
        <div class="fixLayout">
            <h2>
                Navigation
            </h2>
            <div class="decoMenu">
                 <?=
                $this->Html->image("deco5.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                ?>
            </div>
            <ul class="navAccount">
                <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                    <i class="fas fa-home"></i>
                    <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                </li>
                <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                    <i class="fas fa-cog"></i>
                    <?= $this->Html->link('Mon compte', array('controller' => 'users', 'action' => 'account')); ?>
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
            <h2>
                Vos abonnements
            </h2>
            <table class="table table-bordered">
                    <?php foreach ($follow as $lastSign): ?>
                      <tr>
                            <th>
                                <?= $lastSign->has('pet') ? $this->Html->link($lastSign->pet->name, ['controller' => 'Pets', 'action' => 'pet', $lastSign->pet->id]) : '' ?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if ($lastSign->has('pet')){
                                        $url= 'files/Pets/photo/'.$lastSign->pet->photo;
                                            echo $this->Html->image($url, [
                                                'height' => '120',
                                                'width' => '120',
                                                'url' => ['controller' => 'Pets', 'action' => 'pet', $lastSign->pet->id]
                                        ]);
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                    <?php endforeach ?>
            </table> 
        </div>
</div>