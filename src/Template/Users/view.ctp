<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users view large-9 medium-8 columns content">
    <h3> <?= h($user->firstname);?>
        <?= h($user->lastname); ?>
    </h3>
    <table class="vertical-table">
        <tr>
            <?php 
                if (!empty($user->avatar)) {
                $url= '/files/Users/avatar/'.$user->avatar;

                echo $this->Html->image($url, [
                    'height' => '100',
                    'width' => '100',
                    'alt'=>'coucou',
                ]);
                }
            ?>
        </tr>

        <tr>
            <th scope="row"><?= __('Inscrit depuis le: ') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
    </table>

    <div class="related">
        <h4><?= __('Articles liés:') ?></h4>
        <?php if (!empty($user->articles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Published') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->articles as $articles): ?>
            <tr>
                <td><?= h($articles->id) ?></td>
                <td><?= h($articles->user_id) ?></td>
                <td><?= h($articles->title) ?></td>
                <td><?= h($articles->slug) ?></td>
                <td><?= h($articles->body) ?></td>
                <td><?= h($articles->published) ?></td>
                <td><?= h($articles->created) ?></td>
                <td><?= h($articles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Ses animaux:') ?></h4>
        <?php foreach ($user->pets as $pets): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nom') ?></th>
                <th scope="col"><?= __('Espèce') ?></th>
            </tr>
            <tr>
                <td><?= h($pets->name) ?></td>
                <td><?= $pets->has('species') ? $this->Html->link($pets->species->name, ['controller' => 'Species', 'action' => 'view', $pets->species->id]) : '' ?></td>
            </tr>              
        </table>
        <?php endforeach; ?>
    </div>
    <div class="related">
        <h4><?= __('Ses animaux:') ?></h4>
        <?php foreach ($user->subscriptions as $pets): ?>
        <table cellpadding="0" cellspacing="0">
                    <td>
                        <?= $pets->id ?>
                    </td>
                    <td>
                       <?= $pets->has('pet') ? $this->Html->link($pets->pet->name, ['controller' => 'Species', 'action' => 'view', $pets->pet->id]) : '' ?>
                        <?= $user->has('user') ? $this->Html->link($user->user->firstname, ['controller' => 'Species', 'action' => 'view', $user->user->id]) : '' ?> 
                    </td>
        </table>
        <?php endforeach; ?>
    </div>
</div>
