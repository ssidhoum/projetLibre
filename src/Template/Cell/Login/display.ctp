<?php
/**
 * @var \App\View\AppView $this
 */
?>

 <li> <?= $this->Form->create() ?> </li>
                <li> <?= $this->Form->control('email', ['placeholder' => 'votre adresse mail','label' => '']) ?> </li>
                <li> <?= $this->Form->control('password',  ['placeholder' => 'votre mot de passe','label' => '']) ?> </li>
                <li><?=  $this->Form->button('GO', array('class' => 'forminput')) 
                       // $this->Html->link('Connexion', array('controller' => 'users', 'action' => 'login', 'class'=>'falseBtn')); 
                ?></li>
                <li><?= $this->Form->end() ?></li>