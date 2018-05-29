<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div>
	<h1>
		Rappel de mot de passe:
	</h1>
	<table>
		<?= $this->Form->create() ?>
		
		<tr>
			<td>
				Votre email:
			</td>
			<td>
				<?php
            		echo $this->Form->control('email', ['type'=>'text', 'label' => ' ']);
     			?>
			</td>
		</tr>
		<tr>
			<td>
				<?= $this->Form->button('Rechercher', ['class' => 'searchBtn']) ?>
			</td>
		</tr>

	<?= $this->Form->end() ?>
	</table>

</div>