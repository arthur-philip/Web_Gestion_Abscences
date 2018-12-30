<?php

class DataManagement
{

    // Définition de l'utilisateur avec lequel on va se connecter à la base de donnée
    private $user = "site_user";
    private $pass = "KzdGtAhJAzLPswLE";

    private $db = null;

    // Constructeur de la classe de gestion des données de la base
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=gestion_eleve;charset=utf8', $this->user, $this->pass);
    }
    
    /**
     * Insertion d'un cours en base de donnée.
     *
     * @param $cours Le cours à insérer dans la base de donnée.
    */
    public function insertCours($cours)
    {
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

    /**
     * Insertion d'un tableau de cours en base de données.
     *
     * @param $cours Les cours à insérer dans la base de donnée.
    */
    public function insertArrayOfCours($cours)
    {
        foreach ($cours as $value) {
            $this->insertCours($value);
        }
    }
    
    /**
     * Vérification de l'existance d'un utilisateur et renvoie du résultat.
     *
     * @param $login Le login de l'utilisateur recherché.
     * @param $password Le mot de passe de l'utilisateur recherché.
     * @return informations/-1 Renvoie les informations utiles de l'utilisateur ou -1.
     */
    public function checkUser($login, $password)
    {
        $reqCheckUser = $this->db->prepare("select nom, prenom, id_responsabilite from personnel where login = ? and mdp = ?");
        if ($reqCheckUser->execute(array($login, $password))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            while ($ligne=$reqCheckUser->fetch()) {
                // Renvoi les infos de l'utilisateur (nom, prénom, responsabilité)
                return [$ligne["nom"], $ligne["prenom"], $ligne["id_responsabilite"]];
            }
        }
        return -1;
    }
}
