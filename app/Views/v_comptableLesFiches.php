<?= $this->extend('l_comptable') ?>

<?= $this->section('body') ?>
<div id="contenu">
	<h2>Liste des fiches de frais</h2>
	 	
	<?php if(!empty($notify)) echo '<p id="notify" >'.$notify.'</p>';?>
	 
	<table class="listeLegere">
		<thead>
			<tr>
				<th >Mois</th>
				<th >Etat</th>  
				<th >Montant</th>  
				<th >Date modif.</th>  
				<th  colspan="4">Actions</th>              
			</tr>
		</thead>
		<tbody>
          
		<?php    
			foreach($lesFiches as $uneFiche) 
			{
				$signeLink = '';

				if ($lesFiche['id'] == 'CR') {
					$signeLink = anchor('comptable/signeMaFiche/'.$uneFiche['mois'], 'signer',  'title="Signer la fiche"  onclick="return confirm(\'Voulez-vous vraiment signer cette fiche ?\');"');
				}

				$date = new DateTime($lesFiche['dateModif']);
				echo 
				'<tr>
					<td class="date">'.anchor('comptable/voirLesFiche/'.$uneFiche['mois'], $uneFiche['mois'],  'title="Consulter les fiche"').'</td>
					<td class="libelle">'.$lesFiche['libelle'].'</td>
					<td class="montant">'.$lesFiche['montantValide'].'</td>
					<td class="date">'.$date->format('d/m/Y').'</td>
					<td class="action">'.$modLink.'</td>
					<td class="action">'.$signeLink.'</td>
				</tr>';
			}
		?>	  
		</tbody>
    </table>

</div>
<?= $this->endSection() ?>