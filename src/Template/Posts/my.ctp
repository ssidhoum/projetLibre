<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="container">
    <div class="containerPet">
        <h1>
            Mes photos
        </h1>
        <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'add')); ?>
    </div>
    <div class="menuAccount">
        <ul class="navAccount">
            <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                <?= $this->Html->link('Mon compte', array('controller' => 'users', 'action' => 'account')); ?>
            </li>
            <li<?php if($this->request->controller == 'pets'): ?> class="active"<?php endif; ?>>
                <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
            </li>
            <li<?php if($this->request->controller == 'posts'): ?> class="active"<?php endif; ?>>
                <?= $this->Html->link('Mes photos', array('controller' => 'posts', 'action' => 'my')); ?>
            </li>
        </ul>
    </div>
</div

