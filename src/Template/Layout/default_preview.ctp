
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
</head>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bases.css') ?>
    <?= $this->Html->css('homes.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                 <?=
                    $this->Html->image("logo.png", [
                    "alt" => "logo instapets",
                    "width" => "25%",
                    'url' => ['controller' => 'Articles', 'action' => 'index']
                    ]);
                ?>
            </li>
        </ul>
        <div class="top-bar-section">  

            
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
                <li><?= $this->Form->button('Connexion') ?></li>
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
