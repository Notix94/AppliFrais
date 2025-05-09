<?= $this->extend('l_comptable') ?>

<?= $this->section('body') ?>
<div id="contenu">
    <h2>suivie des payement des fiches de frais</h2>

    <?php if (!empty($notify)) echo '<p id="notify" >' . $notify . '</p>'; ?>

    <table class="listeLegere">
        <thead>
            <tr>
                <th >Visiteur</th>
                <th >Etat</th>  
                <th >Total</th>  
                <th >Date modif.</th>  
                <th colspan="4">Actions</th>  
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($suivieFiches as $uneFiche) {
                $misePLink = '';
                $rembourser ='';
               
                if ($uneFiche['id'] == 'VA') {
                    $misePLink = anchor('comptable/miseEnPaiement/' . $uneFiche['mois'], 'en Paiement', 'title="Mettre en paiement"  onclick="return confirm(\'Voulez-vous vraiment mettre en paiement cette fiche ?\');"');
                }
                if ($uneFiche['id'] == 'MP') {
                    $misePLink = anchor('comptable/estRembourser/' . $uneFiche['mois'], 'a Rembourser', 'title="Mettre en Remboursement"  onclick="return confirm(\'Voulez-vous vraiment rembourser cette fiche ?\');"');
                }
                $date = new DateTime($uneFiche['dateModif']);
               
                echo
                '<tr>
					<td class="date">' . anchor('comptable/voirLesFiche/' . $uneFiche['mois'], $uneFiche['idVisiteur'], 'title="Consulter les fiche"') . '</td>
					<td class="libelle">' . $uneFiche['libelle'] . '</td>
					<td class="montant">' . $uneFiche['montantValide'] . '</td>
					<td class="date">' . $date->format('d/m/Y') . '</td>
					<td class="action">'.$misePLink.'</td>  <!-- Lien modifié -->
                    <td class="action">'.$rembourser.'</td>  <!-- Lien modifié -->
				</tr>';
            }
            ?>	  
        </tbody>
    </table>

</div>
<?= $this->endSection() ?>