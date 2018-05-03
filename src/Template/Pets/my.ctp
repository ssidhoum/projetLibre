<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="container">
    <div class="containerAccount">
        <h1>
            Mon compte
        </h1>
        <h2>
            Changer vos informations
        </h2>
        <i class="fas fa-plus-circle"></i>
        <?= $this->Html->link('Ajouter un animal', array('controller' => 'pets', 'action' => 'add')); ?>

        <table class="table table-bordered">
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
                        <?= $this->Html->link('Voir les photos', array('action' => 'pet', $pet->id), array(), 'Voulez vous vraiment supprimer ?'); ?>, 
                        -
                        <?= $this->Html->link('Editer', array('action' => 'edit', $pet->id)); ?>
                        -
                        <?= $this->Form->postLink('Supprimer', array('action' => 'delete', $pet->id), array(), 'Voulez vous vraiment supprimer ?'); ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table> 
    </div>
    <div class="menuAccount">
        <ul class="navAccount">
            <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-cog"></i>
                <?= $this->Html->link('Mon compte', array('controller' => 'users', 'action' => 'account')); ?>
            </li>
            <li<?php if($this->request->action === 'my'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-cog"></i>
                <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
            </li>
            <li<?php if($this->request->action == 'edit'): ?> class="active"<?php endif; ?>>
                <i class="fas fa-plus-circle"></i>
                <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
            </li>
        </ul>
    </div>
</div>