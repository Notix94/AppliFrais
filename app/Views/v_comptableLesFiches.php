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
                <th >Mois</th>
				<th >Montant</th>  
				<th >Date modif.</th>  
				<th colspan="4">Actions</th>
                           
			</tr>
		</thead>
		<tbody>
          
	<?php    
    foreach($lesFiches as $uneFiche) 
    {
        $validerLink = '';
        $refuserLink = '';  // Définir modLink à une valeur vide ou ajouter un lien approprié

        // Lien pour signer la fiche
        if ($uneFiche['id'] == 'CL') {
            $validerLink = anchor('comptable/validerMaFiche/'.$uneFiche['mois'], 'valider',  'title="Valider la fiche"  onclick="return confirm(\'Voulez-vous vraiment valider cette fiche ?\');"');
         // Exemple d'un lien pour modifier la fiche
        $refuserLink = anchor('#', 'refuser', 'title="Refuser la fiche" onclick="showMotif();   return false;"');

            }

      
        $date = new DateTime($uneFiche['dateModif']);
        echo 
        '<tr>
                <td class="date">'.$uneFiche['idVisiteur'].'</td>
            <td class="libelle">'.$uneFiche['libelle'].'</td>
                <td class="date">'.$uneFiche['mois'].'</td>
            <td class="montant">'.$uneFiche['montantValide'].'</td>
            <td class="date">'.$date->format('d/m/Y').'</td>
            <td class="action">'.$refuserLink.'</td>  <!-- Lien modifié -->
            <td class="action">'.$validerLink.'</td>
        

        </tr>';
    }
?>	  

<div class="motif_F" style="display:none;">
<form action="<?= base_url('comptable/refuserFiche/'.$uneFiche['mois']) ?>" method="POST" id="formRefus">
    <p style="background-color: white">Entrer votre Motif de Refus</p>
    <textarea class="motifText" name="motif" rows="3" cols="50" required></textarea>
    <input type="hidden" name="mois" value="<?= $uneFiche['mois'] ?>">

    <button type="button" id="btnValiderMotif">Valider Motif</button>
</form>


</div>


 <script>
    const motif_F =  document.querySelector('.motif_F')
    const motifText = document.querySelector('.motifText')

    const showMotif =  () =>{      
       motif_F.style.display = 'block';
    }

    document.querySelector('#btnValiderMotif').addEventListener('click', function () {
    if (confirm('Voulez-vous vraiment refuser cette fiche ?')) {
        // Soumettre le formulaire
        document.querySelector('#formRefus').submit();
    }
});
 </script>

		</tbody>
    </table>
</div>
<?= $this->endSection() ?>