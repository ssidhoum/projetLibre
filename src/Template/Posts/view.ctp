<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>

<div class="container">
    <div class="containerAccount">
    	<table>
			<tr>
				<th>
					<?= h($post->name);?>
				</th>
			</tr>
			<tr>
				<td>
				<?php $url= 'files/Posts/photo/'.h($post->photo);
    			echo $this->Html->image($url, [
        		'height' => '500',
        		'width' => '520'
				]);?>
				</td>
			</tr>
			<tr>
				<td>
					<?= h($post->content);?>
				</td>
			</tr>
		</table>
    </div>
    <div class="menuAccount">

		<div class="related">
            <h4><?= __('<i class="fas fa-comments"></i> Commentaires: ') ?></h4>
            <?php foreach ($post->comments as $comments): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td><?= h($comments->id) ?></td>
                    <td><?= h($comments->content) ?></td>
                    <td>
                    <?php if($comments->has('user_id')){
                        echo $comments->user_id->firstname;
                    }  ?>
                </td>
                </tr>              
            </table>
            <?php endforeach; ?>
    	</div>

        <ul class="navAccount">
            <li>
				<?= 
				$this->Html->link(
    			'Ajouter commentaire',
    			'/comments/add/'.$post->id
				);?>
            </li>
        </ul>
    </div>
</div>