<?= $this->extend('l_comptable') ?>

<?= $this->section('body') ?>
<div id="contenu">
	<h2>Gestion des fiche des visiteur</h2>
	<p>Bienvenue dans votre application de gestion des frais de déplacements des visiteur. </p>
	<p>
		découvrez les frais des déplacements professionnels des visiteurs.
		<ul>
			<li>Une fiche de frais court du 1er au dernier jour du mois;
			<li>Les fiches de frais sont créées automatiquement par l'application au fil de votre utilisation;
			<li>Vous complétez les fiches de frais à votre rythme;
			<li>Lorsqu'une fiche est totalement renseignée, vous devrez la "valider" ou la "refuser";
		</ul>
	</p>

	<p>
		Au moyen du bandeau gauche, vous avez accès aux fonctionalités 
		du profil comptable : 
		<ul>
			<li>valider ou refuser les fiches de frais des visiteur</li>
			<li>Se déconnecter</li>
		</ul>
	</p>
</div>
<?= $this->endSection() ?>