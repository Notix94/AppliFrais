<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use \App\Models\Authentif;
use \App\Models\ActionsComptable; 
/**
 * Description of Comptable
 *
 * @author yhenaff
 */
class Comptable extends BaseController{
    //put your code here
    
	private $authentif;
	private $idUtilisateur;
	private $data;
	private $actComptable;
	private $session;
   
	/**
	 * Constructeur du contrôleur : constructeur fourni par CodeIgniter. S'exécute après le 
	 * constructeur PHP __construct
	 *
	 * Note 1 : Aurait pu être utilisé pour empêcher l'accès aux non-visiteurs mais un constructeur 
	 * 					ne permet pas de renvoyer une vue. Donc pas de vue "erreur" et pas de vue 
	 * 					"connexion" non plus. 
	 * Note 2 : L'interdiction d'accès à ce contrôleur pour les non-visiteurs est opérée par le 
	 * 					biais de "Controller filters" (voir app/Filters/VisiteurFilter.php et 
	 * 					app/Config/Filters.php)
	 */
	public function initController(RequestInterface $request, ResponseInterface $response,
			LoggerInterface $logger ) {
				
		parent::initController($request, $response, $logger);

		// Initialisation des attributs de la classe
		$this->authentif = new Authentif();
		$this->session = session();
		$this->idUtilisateur = $this->session->get('idUser');
		$this->data['identite'] = $this->session->get('prenom').' '.$this->session->get('nom');
		$this->actComptable = new ActionsComptable($this->idUtilisateur);

	}

	/**
	 * Méthode par défaut qui renvoie la page d'acceuil 
	 */
	public function index()
	{
		// envoie de la vue accueil du visiteur
		return view('v_comptableAccueil', $this->data);
	}

	/**
	 * Restitue les liste des fiches du visiteur connecté, sans détails
	 */ 
	public function  lesFiches($message = "")
	{
		$this->data['lesFiches'] = $this->actComptable->getLesFichesDesVisiteurCL();
		$this->data['notify'] = $message;

		return view('v_comptableLesFiches', $this->data);	
	}
        
        public function  suivieFiches($message = "")
	{
		$this->data['suivieFiches'] = $this->actComptable->getLesFichesDesVisiteur();
		$this->data['notify'] = $message;

		return view('v_comptableSuivieFiches', $this->data);	
	}

	/**
	 * Déconnecte la session
	 */
	public function seDeconnecter()	
	{
		return $this->authentif->deconnecter();
	}

	/**
	 * Affiche le détail d'une fiche de frais du visiteur connecté, en lecture seule
	 *
	 * @param : le mois de la fiche concernée
	 */
	

        public function validerMaFiche($mois)
	{	// TODO : contrôler la validité du mois de la fiche à modifier

		$this->actComptable->ValiderLaFiche($mois);
		// ... et on revient à mesFiches
		return $this->lesFiches("La fiche $mois a été valider. <br/>je deteste ce tp.");
	}
	
	public function refuserFiche($mois){
		$this->actComptable->refuserLaFiche($mois);
		// ... et on revient à mesFiches
		return $this->lesFiches("La fiche $mois a été refuser. <br/>je deteste ce tp.");
	}
}

