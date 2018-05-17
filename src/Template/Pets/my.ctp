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
        <div class="containerPets">
            <h1>
                Vos animaux
            </h1>

            <div class="addPet">
                <i class="fas fa-plus-circle"></i>
                <?= $this->Html->link('Ajouter un animal', array('controller' => 'pets', 'action' => 'add')); ?>
            </div>

            <table class="tablePets">
                <thead>
                    <tr>
                    <th>Photo de profil </th>
                    <th>Nom</th>
                    <th>Age</th>
                    <th>Animal</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pets as $pet): ?>
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
                        </td>
                        <td><?= h($pet->name)  ?></td>
                        <td>
                            <?php
                            $birthday = new DateTime(h($pet->birthday));
                            echo $birthday->diff(new DateTime('now'))->y
                            ?> Ans
                        </td>
                        <td><?= $pet->has('species') ? $this->Html->link($pet->species->name, ['controller' => 'Species', 'action' => 'view', $pet->species->id]) : '' ?></td>
                        <td>
                        <?= $this->Html->link('Voir les photos', array('action' => 'pet', $pet->id), array(), 'Voulez vous vraiment supprimer ?'); ?>
                         // 
                        <?= $this->Html->link('Editer', array('action' => 'edit', $pet->id)); ?>
                         // 
                        <?= $this->Form->postLink('Supprimer', array('action' => 'delete', $pet->id), array(), 'Voulez vous vraiment supprimer ?'); ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    

        
    </div>

</div>