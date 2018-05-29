<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php if ($this->request->session()->read('Auth.User')) :?>
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
                        <?= $this->Html->link('Messagerie', array('controller' => 'messages', 'action' => 'inbox')); ?>
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
            <?php if (($follow->isEmpty())) : ?>
                <div>
                <h1>
                    Bienvenue sur Instapets
                </h1>
                <p>
                    Vous êtes nouveau? <br/> Laissez nous vous guider!
                </p>
                <h2>
                    
                    <?= $this->Html->link('1ère étape: compléter votre profil', array('controller' => 'users', 'action' => 'account')); ?>
                </h2>
                <p>
                    afin de pouvoir mieux s'intégrer à notre communauté. N'hésitez pas à compléter votre profil en y rajouter votre prénom, une photo de profil, votre date de naissance.
                </p>
                <h2>                
                    <?= $this->Html->link('2ème étape: ajouter vos animaux', array('controller' => 'pets', 'action' => 'add')); ?>
                </h2>
                <p>
                    afin de pouvoir mieux s'intégrer à notre communauté. N'hésitez pas à compléter votre profil en y rajouter vos animaux, leur espèce, leur race, et leur photos.
                <h2>
                    3ème étape: découvrer nos utilisateurs
                </h2>
                <p>
                    afin de pouvoir mieux s'intégrer à notre communauté. N'hésitez pas à découvrir nos utilisateurs et aimez ceux qui vous ressemble.
                </p>
            </div>
            <?php else: ?>
                <div class="actuality">
                    <h1>
                        Fils d'actualité
                    </h1>
                    <div>
                        <table class="tablePosts">
                            <tbody>
                            <?php foreach ($lastPost as $post): ?>
                                <tr class="containerActu">
                                    <th>
                                        <?=
                                            $post->has('user') ? $this->Html->link("   ".$post->pet->name, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' 
                                        ?>
                                    </th>
                                </tr>
                                <tr class="containerActu">
                                    <td class="containerActuTD">
                                        <?php
                                            $url= 'files/Posts/photo/'.$post->photo;
                                            echo $this->Html->image($url, [
                                                'class'=>'postsActu',
                                                'url' => ['controller' => 'Posts', 'action' => 'view', $post->id]
                                            ]);
                                        ?> <br/>
                                        <i class="far fa-heart"></i> <?= $this->Html->link("J'aime ", array('controller' => 'posts', 'action' => 'like', $post->id)); ?>  <i class="fas fa-comments"></i>  <?= $this->Html->link("Je commente ", array('controller' => 'comments', 'action' => 'add', $post->id)); ?> </span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    
            <?php endif ?>
                <div class="news">
                <div class="search">
                    <?= $cell = $this->cell('Search'); ?>
                </div>
                <div class="LastPets">
                    <h2>
                        Derniers abonnés:
                    </h2>
                    <div class="containerLastPets">
                        <?php foreach ($recentPets as $pet): ?>
                        <table>
                        <tr>
                            <th>
                                <?= h($pet->name);?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                        <?php
                            $birthday = new DateTime(h($pet->birthday));
                            echo $birthday->diff(new DateTime('now'))->y
                            ?> Ans
                            </td>
                        </tr>
                        <tr>
                            <td>
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
                            </td>
                        </tr>
                        </table>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="LastComments">
                    <h2>
                        Les derniers commentaires:
                    </h2>
                </div>
                    </div>
        </div>

    </div>
<?php else: ?>
    <div class="mainLayout">
        <div class="logoLayout">
            <?=
                $this->Html->image("logo_V2.png", [
                    "alt" => "logo instapets",
                    "class" => "logoInstaPet",
                    'url' => ['controller' => 'users', 'action' => 'home']
            ]);
            ?>
            <br/>
             <?php
            echo $this->Html->link(
            'Rejoignez notre communauté',
            '/Users/add',
            ['class' => 'btnHome', 'target' => '_blank']
            );?>
        </div>
        <div class="deco1">
            <?=
                $this->Html->image("patte.png", [
                    "alt" => "logo instapets",
                    "width" => "100%",
            ]);
            ?>
        </div>
    </div>
    <div class="deco2">
            <?=
                $this->Html->image("balle.png", [
                    "alt" => "logo instapets",
                    "width" => "100%",
            ]);
            ?>
    </div>
    <div class="deco3">
            <?=
                $this->Html->image("ligne.png", [
                    "alt" => "logo instapets",
                    "width" => "100%",
            ]);
            ?>
    </div>
    <div class="secondLayout">
            <h1>
                Découvrez InstaPet
            </h1>
            <h2>
                La communauté des amoureux des animaux.
            </h2>
            <p>
                InstaPet c'est une communauté, où tous les amis des amoureux sont les bienvenus
            </p>
            <ul class="listSecond">
                <li>
                    -Partager vos photos.
                </li>
                <li>
                    -Suivez vos utilisateurs préferés
                </li>
            </ul>
            <div>
                    <?=
                $this->Html->image("frise1.png", [
                    "alt" => "logo instapets",
                    "class"=>"friseLayout",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                    ?>
            </div>

            <div>
                    <?=
                $this->Html->image("frise2.png", [
                    "alt" => "logo instapets",
                    "class"=>"frise2Layout",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                    ?>
            </div>            
    </div>
<?php endif ?>