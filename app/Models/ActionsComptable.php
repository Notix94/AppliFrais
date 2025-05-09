<?php namespace App\Models;

use CodeIgniter\Model;
use \App\Models\DataAccess;
use \DateTime;
use \DateInterval;

/**
 * Modèle représentant tous les traitements possibles attachés à un Utilisateur désigné
 *
 */
class ActionsComptable extends Model {

	private $dao;
	private $idComptable;
	 
	function __construct($idComptable)
	{
		// Call the Model constructor
		parent::__construct();

		// chargement du modèle d'accès aux données qui est utile à toutes les méthodes
		$this->dao = new DataAccess();
		$this->idComptable = $idComptable;
	}

	/**
	 * Mécanisme de contrôle d'existence des fiches de frais sur les 6 derniers 
	 * mois pour un Utilisateur donné. 
	 * Si l'une d'elle est absente, elle est créée.
	 * 
	*/
	public function checkLastSix()
	{	
		// date courante
		$date = new DateTime ("now");
		// interval de 1 mois
		$interval = new DateInterval('P1M');
		
		// Six tours de boucle
		for($i=1; $i<=6; $i++) {
			// la date au format aaaamm
			$unMois = $date->format('Ym');
			// si la fiche pour le mois concerné n'existe pas, ...
			if(!$this->dao->existeFiche($this->idComptable, $unMois)) {
				// ...on la crée
				$this->dao->insertFiche($this->idComptable, $unMois);
			}
			// le mois précédent
			$date->sub($interval);
		}
	}
	
	/**
	 * Liste les fiches existantes d'un Utilisateur 
	 *
	 * @param $message : message facultatif destiné à notifier l'utilisateur du résultat d'une action précédemment exécutée
	*/
	public function getLesFichesDesVisiteur($message=null)
	{		
		return $this->dao->getLesFichesDuSuivie($this->idComptable);
	}	

	public function getLesFichesDesVisiteurCL($message=null)
	{		
		return $this->dao->getLesFichesCL($this->idComptable);
	}
	/**
	 * Retourne le détail de la fiche sélectionnée 
	 * 
	 * @param $mois : le mois de la fiche à modifier 
	*/
	public function getLesFiche($mois)
	{	
		$res = array();
		
		$res['lesFraisHorsForfait'] = $this->dao->getLesLignesHorsForfait($this->idUtilisateur, $mois);
		$res['lesFraisForfait'] = $this->dao->getLesLignesForfait($this->idUtilisateur, $mois);		
		
		return $res;
	}

	/**
	 * Signe une fiche de frais en modifiant son état de "CR" à "CL"
	 * Ne fait rien si l'état initial n'est pas "CR"
	 * 
	 * @param $mois : le mois de la fiche à signer
	*/
	public function validerLaFiche($mois)
	{	// TODO : intégrer une fonctionnalité d'impression PDF de la fiche

		$lesFiche = $this->dao->getLesFichesE('CL');
		
		foreach ($lesFiche as $fiche) {

			if($fiche['mois'] == $mois && $fiche['id']=='CL'){
				$this->dao->updateEtatFiche($fiche['idVisiteur'], $mois,'VA');
		}	
		}
		
	}
	public function refuserLaFiche($mois,$motif)
	{	// TODO : intégrer une fonctionnalité d'impression PDF de la fiche

		$lesFiche = $this->dao->getLesFichesE('CL');
		
		foreach ($lesFiche as $fiche) {

			if($fiche['mois'] == $mois && $fiche['id']=='CL'){
				$this->dao->updateEtatFiche($fiche['idVisiteur'], $mois,'RF');
				 // Mise à jour du motif dans la fiche refusée
				 $this->dao->updateMotifFiche($fiche['idVisiteur'], $mois, $motif);
		}	
		}
		
	}

	public function mettreEnPaiement($mois)
	{	// TODO : intégrer une fonctionnalité d'impression PDF de la fiche

		$lesFiche = $this->dao->getLesFichesE('VA');
		
		foreach ($lesFiche as $fiche) {
			
			if($fiche['mois'] == $mois && $fiche['id']=='VA'){
				$this->dao->updateEtatFiche($fiche['idVisiteur'], $mois,'MP');
		}	
		}
		
	}

	public function isRembourser($mois)
	{	// TODO : intégrer une fonctionnalité d'impression PDF de la fiche

		$lesFiche = $this->dao->getLesFichesE('MP');
		
		foreach ($lesFiche as $fiche) {
			
			if($fiche['mois'] == $mois && $fiche['id']=='MP'){
				$this->dao->updateEtatFiche($fiche['idVisiteur'], $mois,'RB');
		}	
		}
		
	}
}