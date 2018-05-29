<?php
/**
 * @var \App\View\AppView $this
 */
?>

   if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Super vous êtes connecté!.');
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }


        $this->set('resultItems', $resultItems);


<?php if ($this->request->session()->read('Auth.User')) :?>
   <div class="container">
    <div class="containerAccount">
        <h1>
            Fil d'actualité
        </h1>
        <div class="containerInfo">
            <div class="">
                <h2>
                    Suggestion: derniers inscrits
                </h2>
                <div class="containerLastPets">
                    <?php foreach ($recentPets as $pet): ?>
                    <td>
                        <tr>
                            <div class="pictureProfil">
                            <?php
                                if(empty($pet->photo)){
                                    if($pet->species_id == 1){
                                        $url= 'files/Pets/photo/chien.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        'url' => ['controller' => 'Pets', 'action' => 'pet', $pet->id]
                                        ]);  
                                    }if($pet->species_id == 2){
                                        $url= 'files/Pets/photo/chat.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        'url' => ['controller' => 'Pets', 'action' => 'pet', $pet->id]
                                        ]);
                                    }if($pet->species_id == 5){
                                        $url= 'files/Pets/photo/lapin.png';
                                        echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        'url' => ['controller' => 'Pets', 'action' => 'pet', $pet->id]
                                        ]);
                                    }
                                }else{
                                    $url= 'files/Pets/photo/'.$pet->photo;
                                    echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        'url' => ['controller' => 'Pets', 'action' => 'pet', $pet->id]
                                    ]);
                                }
                            ?>
                            </div>
                        </tr>
                        <tr><?= h($pet->name)  ?></tr>
                        <tr>
                            <?php
                            $birthday = new DateTime(h($pet->birthday));
                            echo $birthday->diff(new DateTime('now'))->y
                            ?> Ans
                        </tr>
                    </td>
                    <?php endforeach; ?>
                </div>
                <h2>
                    Derniers posts de vos abonnés:
                </h2>
              
                <table class="table table-bordered">
                <tbody>
                    <?php foreach ($lastPost as $post): ?>
                        <tr>
                            <td>
                                <?php
                                    $url= 'files/Posts/photo/'.$post->photo;
                                    echo $this->Html->image($url, [
                                        'height' => '120',
                                        'width' => '120',
                                        'url' => ['controller' => 'Posts', 'action' => 'view', $post->id]
                                    ]);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                </table> 

            </div>
        </div>
    </div>
    <div class="menuAccount">
        <ul class="navAccount">
            <li>
                <i class="fas fa-cog"></i>
                <?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>
                <?= $this->Html->link('Mes informations', array('controller' => 'users', 'action' => 'account')); ?>
            </li>
            <li>
                <i class="fas fa-paw"></i>
                <?php if($this->request->controller == 'pets'): ?> class="active"<?php endif; ?>
                <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
            </li>
            <li<?php if($this->request->controller == 'posts'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-plus-circle"></i>
                <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
            </li>
        </ul>
        <div class="">
            <div class="containerLastPets">
                <h2>
                    Vos abonnements:
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
                                                    'url' => ['controller' => 'Pets', 'action' => 'pet', $pet->id]
                                            ]);
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table> 
            </div>
            <div class="">
                
                
               
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="containerHome">
        <div class="greenHome">
        <div class="form">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Rejoignez nous') ?></legend>
                <?php
                    echo $this->Form->control('email', ['label'=>'Votre email: ']);
                    echo $this->Form->control('password', ['label'=>'Votre mot de passe: ']);
                    echo $this->Form->control('password2', ['label'=>'Retapez votre mot de passe: ']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Inscription')) ?>
            <?= $this->Form->end() ?>
            <p class="or"> 
                OU <br/>
            </p>
            <div class="icones">
                <div class="instaIcon">
                    <p>
                        Se connecter <br/>
                        avec insta
                    </p>
                    <?php 
                        echo $this->Html->image("insta.png", [
                            "alt" => "logo instapets",
                            "class" => "iconDeco"
                        ]);
                    ?> 
                </div>
                <div class="fbIcon">

                    <?php 
                        echo $this->Html->image("facebook.png", [
                            "alt" => "logo instapets",
                            "class" => "iconDeco"
                        ]);
                    ?>
                    <p>
                        Se connecter <br/>
                        avec facebook
                    </p>
                </div>
             </div>
        </div>
        </div>
        <div class="whiteHome">
            <h1 class="h1Home">
                Découvrez instapet
            </h1>
            <h2 class="quoteHome">
                <i class="fas fa-quote-left"></i>
                On peut juger de la grandeur d'une nation par la façon dont les animaux y sont traités.
                <i class="fas fa-quote-right"></i>
            </h2>
            </div>
        </div>
    </div>
<?php endif ?>