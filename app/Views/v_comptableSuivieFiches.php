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
                             
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($suivieFiches as $uneFiche) {
                $signeLink = '';

                if ($suivieFiche['id'] == 'CR') {
                    $signeLink = anchor('comptable/signeMaFiche/' . $uneFiche['mois'], 'signer', 'title="Signer la fiche"  onclick="return confirm(\'Voulez-vous vraiment signer cette fiche ?\');"');
                }

                $date = new DateTime($suivieFiche['dateModif']);
                echo
                '<tr>
					<td class="date">' . anchor('comptable/voirLesFiche/' . $uneFiche['mois'], $uneFiche['mois'], 'title="Consulter les fiche"') . '</td>
					<td class="libelle">' . $suivieFiche['libelle'] . '</td>
					<td class="montant">' . $suivieFiche['montantValide'] . '</td>
					<td class="date">' . $date->format('d/m/Y') . '</td>
					
				</tr>';
            }
            ?>	  
        </tbody>
    </table>

</div>
<?= $this->endSection() ?>