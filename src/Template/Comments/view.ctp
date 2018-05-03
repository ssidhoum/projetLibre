<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>

<h2>
    Commentaire:
</h2>
<p>
   <?= h($comment->content) ?> 
   <br/>
</p>
<br/>
<p>
    par :
</p>

<?= $comment->has('user') ? $this->Html->link("   ".$comment->user->firstname, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?>

