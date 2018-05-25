<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="formSearch">
	<table>
		<?= $this->Form->create() ?>
		<tr>
			<td>
				<h3>
					Votre recherche
				</h3>
			</td>
		</tr>
		<tr>
			<td>
				Nom de l'animal
			</td>
			<td>
				<?php
            		echo $this->Form->control('name', ['default' => $resultItems, 'type'=>'text', 'label' => ' ']);
     			?>
			</td>
		</tr>
		<tr>
			<td>
				<?= $this->Form->button(__('Rechercher')) ?>
				<?= $this->Form->end() ?>
			</td>
		</tr>


	</table>
</div>
<div class="resultSearch">
	<h3>
		Résultat(s):
	</h3>
	<table>
		<?php foreach ($resultItems as $items) : ?>
			<tr>
				<td>
					<?php
                    if (!empty($items->photo)) {
                        $url= 'files/Pets/photo/'.$items->photo;
                            echo $this->Html->image($url, [
                                'height' => '120',
                                'width' => '120',
                            ]);
                	}?>
				</td>
				<td>
					<?= 
					$this->Html->link($items->name, ['controller' => 'Pets', 'action' => 'pet', $items->id]); ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>