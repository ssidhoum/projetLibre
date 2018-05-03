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

    <?= $this->Html->css('styleDefaut.css') ?>
    <?= $this->Html->css('style2.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
    <nav>
        <ul class="title-area large-3 medium-4 columns listnav">
            <li class="logo">
                 <?=
                    $this->Html->image("logo_V2.png", [
                    "alt" => "logo instapets",
                    "class" => "logo",
                    "width" => "25%",
                    'url' => ['controller' => 'users', 'action' => 'home']
                    ]);
                ?>
            </li>
        </ul>

        <div class="formConnexionMenu">  
        <?php if ($this->request->session()->read('Auth.User.id')) :?>
            <ul class="nav pull-right">
                
                <li><?= $this->Html->link('Paramètre', array('controller' => 'users', 'action' => 'account')); ?></li>
                <li><?= $this->Html->link('Se déconnecter', array('controller' => 'users', 'action' => 'logout')); ?></li>
            <?php if ($this->request->session()->read('Auth.User.role') == 'admin'): ?>
                <li><?= $this->Html->link('Espèces', '/admin/species'); ?></li>
        <?php endif ?>
            </ul>
            <?php else: ?>

            <ul class="formConnexionMenu">

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
</body>
</html>
