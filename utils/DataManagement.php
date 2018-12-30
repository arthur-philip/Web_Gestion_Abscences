<?php

class DataManagement
{

	private $user = "site_user";
	private $pass = "KzdGtAhJAzLPswLE";
	private $dbName = "gestion_eleve";

    private $db = null;

    public function __construct() {
		$this->db = new PDO('mysql:host=localhost;dbname=gestion_eleve;charset=utf8', $this->user, $this->pass);
    }
	
	public function insertCours($cours) {
		// Remplis la table Cours
		$reqCours = $this->db->prepare("INSERT INTO cours (id_matiere, numero_salle, id_groupe, horaire_debut, horaire_fin) VALUES (:idMatiere, :idSalle, :idGroup, :hDebut, :hFin)");
		$reqCours->bindValue(':idMatiere', $idMatiere);
		$reqCours->bindValue(':idSalle', $idSalle);
		$reqCours->bindValue(':idGroup', $idGroup);
		$reqCours->bindValue(':prof', $idProf);
		$reqCours->bindValue(':hDebut', $cours->getDateDebut());
		$reqCours->bindValue(':hFin', $cours->getDateFin());
		$reqProf->execute();
	}

	public function insertArrayOfCours($cours) {
		foreach ($cours as $value) {
			$this->insertCours($value);
		}
	}
	
	public function checkUser($login, $password){
		$reqCheckUser = $this->db->prepare("select nom, prenom, id_responsabilite from personnel where login = ? and mdp = ?");
		if($reqCheckUser->execute(array($login, $password))){
			// Si les informations sont correctes (au moins un résultat trouvé)
			while($ligne=$reqCheckUser->fetch()){
				// Renvoi les infos de l'utilisateur (nom, prénom, responsabilité)
				return [$ligne["nom"], $ligne["prenom"], $ligne["id_responsabilite"]];
			}
		}
		return -1;
	}

}

?>