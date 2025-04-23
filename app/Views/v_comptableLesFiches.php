<?= $this->extend('l_comptable') ?>

<?= $this->section('body') ?>
<div id="contenu">
	<h2>Liste des fiches de frais</h2>
	 	
	<?php if(!empty($notify)) echo '<p id="notify" >'.$notify.'</p>';?>
	 
	<table class="listeLegere">
		<thead>
			<tr>
                            <th>Id</th>
				
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
        $validerLink = '';
        $rembourserLink = '';  // Définir modLink à une valeur vide ou ajouter un lien approprié

        // Lien pour signer la fiche
        if ($uneFiche['id'] == 'CL') {
            $validerLink = anchor('comptable/signeMaFiche/'.$uneFiche['mois'], 'valider',  'title="Valider la fiche"  onclick="return confirm(\'Voulez-vous vraiment valider cette fiche ?\');"');
         // Exemple d'un lien pour modifier la fiche
        $rembourserLink = anchor('comptable/modifierFiche/'.$uneFiche['mois'], 'rembourser', 'title="Rembourser la fiche"');

            }

      
        $date = new DateTime($uneFiche['dateModif']);
        echo 
        '<tr>
            <td class="date">'.anchor('comptable/voirLesFiche/'.$uneFiche['idVisiteur'], $uneFiche['idVisiteur'],  'title="Consulter les fiches"').'</td>
            <td class="libelle">'.$uneFiche['libelle'].'</td>
            <td class="montant">'.$uneFiche['montantValide'].'</td>
            <td class="date">'.$date->format('d/m/Y').'</td>
            <td class="action">'.$rembourserLink.'</td>  <!-- Lien modifié -->
            <td class="action">'.$validerLink.'</td>
        </tr>';
    }
?>	  	  
		</tbody>
    </table>

</div>
<?= $this->endSection() ?>