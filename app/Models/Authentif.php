<?php namespace App\Models;

use CodeIgniter\Model;
use \App\Models\DataAccess;

class Authentif extends Model
{
	private $session;
	
    function __construct()
    {
      parent::__construct();
			$this->session = session();
    }

	/**
	* Teste si l'utilisateur est connecté comme Visiteur
	* 
	* @return true ou false selon que l'utilisateur est connecté ou pas
	*/
	public function estVisiteur()
	{	// TODO : A faire évoluer dès lors qu'il y aura des comptables gérés dans l'application
	  return !is_null($this->session->get('idUser')) && $this->session->get('role') === 'visiteur';
	}
        public function estComptable()
	{	
	  return !is_null($this->session->get('idUser')) && $this->session->get('role') === 'comptable';
	}
	
	/**
	 * Enregistre dans une variable de session les infos de l'utilisateur connecté
	 * 
	 * @param $authUser tableau assocatif contenant les caractéristiques de l'utilisateur à enregistrer
	 */
	public function connecter($authUser)
	{ // TODO : Lorsqu'il y aura d'autres profils d'utilisateurs (comptables, etc.)
	  // il faudra ajouter cette information de profil dans la session 
		$this->session->set('idUser', $authUser['id']);
		$this->session->set('nom', $authUser['nom']);
		$this->session->set('prenom', $authUser['prenom']);
		$this->session->set('login', $authUser['login']);
                $this->session->set('role', $authUser['role']);
	}

	/**
	 * Détruit la session active et redirige vers le contrôleur par défaut
	 */
	public function deconnecter()
	{
		$authUser = array('idUser', 'nom', 'prenom', 'login', 'role');
		$this->session->remove($authUser);
		$this->session->destroy();

		return redirect()->to('/anonyme');
	}

	/**
	 * Vérifie en base de données si les informations de connexions sont correctes
	 * 
	 * @return : renvoie l'id, le nom et le prenom de l'utilisateur dans un tableau s'il est reconnu, sinon un tableau vide.
	 */
	public function authentifier ($login, $mdp) 
	{
		$dao = new DataAccess();
		$authUser = $dao->getUtilisateur($login);
		
		if (empty($authUser) or ($authUser['mdp'] != $mdp)) {
			$authUser = null;
		}
		else {
			$authUser['mdp'] ='';
		}

		return $authUser;
	}
}