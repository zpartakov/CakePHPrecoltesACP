<div class="recolteslegumes view">
	
	<h2><?php ___('recolteslegume');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $recolteslegume['Recolteslegume']['id'], 'delete_id' => $recolteslegume['Recolteslegume']['id'], 'delete_text' => ___('do you really want to delete this recolteslegume ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('recolte'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Recolte']['date'], array('controller' => 'recoltes', 'action' => 'view', $recolteslegume['Recolte']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('legume'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Legume']['lib'], array('controller' => 'legumes', 'action' => 'view', $recolteslegume['Legume']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Unite']['lib'], array('controller' => 'unites', 'action' => 'view', $recolteslegume['Unite']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb caisse'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisse']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par caisse kg pce'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['par_caisse_kg_pce']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par caisse reste'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['par_caisse_reste']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg pce total par lieu'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_total_par_lieu']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('recolte kg piece total'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['recolte_kg_piece_total']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb caisses gp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisses_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb caisses pp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisses_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets par caisse gp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['cornets_par_caisse_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets par caisse pp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['cornets_par_caisse_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg pce par cornet gp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_par_cornet_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg pce par cornet pp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_par_cornet_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('remarques'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['remarques']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
