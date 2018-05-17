<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('6.css') ?>
    <?= $this->Html->css('aze.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
    <nav class="navDefaut">
        <ul>
            <li class="logo">
                <?=
                    $this->Html->image("pet.png", [
                    "alt" => "logo instapets",
                    "class" => "logo",
                    "width" => "90%",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                ?>
            </li>
        
        <div class="formConnexionMenu">  
        <?php if ($this->request->session()->read('Auth.User.id')) :?>
                <li><?= $this->Html->link('Déconnexion', array('controller' => 'users', 'action' => 'logout')); ?></li>
                <?php if ($this->request->session()->read('Auth.User.role') == 'admin'): ?>
                    <li><?= $this->Html->link('Espèces', '/admin/species'); ?></li>
                <?php endif ?>
            
        <?php else: ?>
            
                <li> <?= $this->Form->create() ?> </li>
                <li> <?= $this->Form->control('email', ['placeholder' => 'votre adresse mail','label' => '']) ?> </li>
                <li> <?= $this->Form->control('password',  ['placeholder' => 'votre mot de passe','label' => '']) ?> </li>
                <li><?=  $this->Form->button('GO', array('class' => 'forminput')) 
                       // $this->Html->link('Connexion', array('controller' => 'users', 'action' => 'login', 'class'=>'falseBtn')); 
                ?></li>
                <li><?= $this->Form->end() ?></li>
            </ul>
        <?php endif ?>
        </div>
    </nav>

    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>

    <footer>
        <p>
            2018-Instapets 
        </p>
    </footer>

    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>


    <?php

    echo $this->Html->script('main');
    echo $this->Html->script('anime.min');
    echo $this->Html->script('particles');

    ?>


</body>
</html>
