<?php

class DataManagement
{

	private $user = "site_user";
	private $pass = "KzdGtAhJAzLPswLE";
	private $dbName = "gestioneleve";

    private $db = null;

    public function __construct() {
		$this->db = new PDO('mysql:host=localhost;dbname=gestioneleve;charset=utf8', $this->user, $this->pass);
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
		$reqCheckUser = $this->db->prepare("select * from personnel where login = ? and password = ?");// TODO: corriger la requete ?
		if($reqCheckUser->execute(array($login, $password))){
			// Si les informations sont correctes (au moins un résultat trouvé)
			while($ligne=$reqCheckUser->fetch()){
				return 0;// TODO: renvoyer la responsabilté de l'utilisateur
			}
		}
		return -1;
	}
   
}

?>