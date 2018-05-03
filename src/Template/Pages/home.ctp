<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="containerHome">
    <div class="users">
        <?= $this->Form->create($user) ?>
        <fieldset>
        <legend><?= __('Rejoignez nous') ?></legend>
            <?php
                echo $this->Form->control('email');
                echo $this->Form->control('password');
                echo $this->Form->control('password');
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
    <div class="deco">
        <div class="quote">
            <h1>
                "On peut juger de la grandeur d'une nation par la façon dont les animaux y sont traités."
            </h1>
        </div>
        <div class"imgDeco">
              <?php 
                    echo $this->Html->image("imgHome.jpg", [
                    "alt" => "logo instapets",
                    "class" => "pixDeco"
                    ]);
                ?>
        </div>
    </div>




</div>




