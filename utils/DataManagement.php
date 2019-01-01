<?php
/**
 * Classe qui contient toutes les fonctions dont le site a besoin pour utiliser la base de données.
 *
 * @author Thibault KUZMYCZ, Jordan PEDRERO, Arthur PHILIP
 */
class DataManagement
{

    // Définition de l'utilisateur avec lequel on va se connecter à la base de données.
    private $user = "site_user";

    // Définition du mot de passe utilisateur avec lequel on va se connecter à la base de données.
    private $pass = "KzdGtAhJAzLPswLE";

    // Déclaration de la varible de la base de données.
    private $db = null;

    // Constructeur de la classe de gestion des données de la base de données.
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=gestion_eleve;charset=utf8', $this->user, $this->pass);
    }
    
    //----------INSERT----------\\

    /**
     * Insertion d'une abscence en base de données.
     *
     * @param $abscence L'abscence à insérer dans la base de données.
    */
    public function insertAbscence($abscence)
    {
        // Remplis la table Abscence
        $reqInsAbs = $this->db->prepare("INSERT INTO abscence (id_cours, ine_etudiant)
            VALUES (:idCours, :ineEtudiant)");
        $reqInsAbs->bindValue(':idCours', $abscence->id_cours);
        $reqInsAbs->bindValue(':ineEtudiant', $abscence->$ine);
        $reqInsAbs->execute();
    }

    // TODO: anime
    
    /**
     * Insertion d'un cours en base de données.
     *
     * @param $cours Le cours à insérer dans la base de données.
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
     * @param $cours Les cours à insérer dans la base de données.
    */
    public function insertArrayOfCours($cours)
    {
        foreach ($cours as $value) {
            $this->insertCours($value);
        }
    }
    
    /**
     * Insertion d'un departement en base de données.
     *
     * @param $departement Le departement à insérer dans la base de données.
    */
    public function insertDepartement($departement)
    {
        // Remplis la table Departement
        $reqInsDept = $this->db->prepare("INSERT INTO departement (libelle)
            VALUES (:libelleDepart)");
        $reqInsDept->bindValue(':libelleDepart', $departement->libelle);
        $reqInsDept->execute();
    }

    /**
     * Insertion d'un étudiant en base de données.
     *
     * @param $etudiant L'étudiant à insérer dans la base de données.
    */
    public function insertEtudiant($etudiant)
    {
        // Remplis la table Etudiant
        $reqInsEtu = $this->db->prepare("INSERT INTO etudiant (ine_etudiant, id_groupe, nom, prenom)
            VALUES (:ineEtudiant, :idGroupe, :nom, :prenom)");
        $reqInsEtu->bindValue(':ineEtudiant', $etudiant->$ine);
        $reqInsEtu->bindValue(':idGroupe', $etudiant->$id_groupe);
        $reqInsEtu->bindValue(':nom', $etudiant->$nom);
        $reqInsEtu->bindValue(':prenom', $etudiant->$prenom);
        $reqInsEtu->execute();
    }

    /**
     * Insertion d'une filiere en base de données.
     *
     * @param $filiere La filiere à insérer dans la base de données.
    */
    public function insertFiliere($filiere)
    {
        // Remplis la table Filiere
        $reqInsFil = $this->db->prepare("INSERT INTO filiere (id_departement, libelle)
            VALUES (:idDepartement, :libelle)");
        $reqInsFil->bindValue(':idDepartement', $filiere->$id_dep);
        $reqInsFil->bindValue(':libelle', $filiere->$libelle);
        $reqInsFil->execute();
    }

    /**
     * Insertion d'un groupe en base de données.
     *
     * @param $groupe Le groupe à insérer dans la base de données.
    */
    public function insertGroupe($groupe)
    {
        // Remplis la table Groupe
        $reqInsGro = $this->db->prepare("INSERT INTO groupe (id_filiere, libelle)
            VALUES (:idFiliere, :libelle)");
        $reqInsGro->bindValue(':idFiliere', $groupe->$id_filiere);
        $reqInsGro->bindValue(':libelle', $groupe->$libelle);
        $reqInsGro->execute();
    }

    // TODO: groupe_etudiant

    /**
     * Insertion d'une matière en base de données.
     *
     * @param $matiere La matière à insérer dans la base de données.
    */
    public function insertMatiere($matiere)
    {
        // Remplis la table Matiere
        $reqInsMat = $this->db->prepare("INSERT INTO matiere (libelle)
            VALUES (:libelle)");
        $reqInsMat->bindValue(':libelle', $matiere->$libelle);
        $reqInsMat->execute();
    }

    /**
     * Insertion d'un membre du personnel en base de données.
     *
     * @param $personnel Le membre du personnel à insérer dans la base de données.
    */
    public function insertPersonnel($personnel)
    {
        // Remplis la table Personnel
        $reqInsPer = $this->db->prepare("INSERT INTO personnel (login, mdp, nom, prenom, id_responsabilite)
            VALUES (:login, :mdp, :nom, prenom, id_responsabilite)");
        $reqInsPer->bindValue(':login', $personnel->$login);
        $reqInsPer->bindValue(':mdp', $personnel->$mdp);
        $reqInsPer->bindValue(':nom', $personnel->$nom);
        $reqInsPer->bindValue(':prenom', $personnel->$prenom);
        $reqInsPer->bindValue(':id_responsabilite', $personnel->$id_responsabilite);
        $reqInsPer->execute();
    }

    /**
     * Insertion d'une responsabilite en base de données.
     *
     * @param $responsabilite La responsabilite à insérer dans la base de données.
    */
    public function insertResponsabilite($responsabilite)
    {
        // Remplis la table Salle
        $reqInsRes = $this->db->prepare("INSERT INTO responsabilite (libelle)
            VALUES (:libelle)");
        $reqInsRes->bindValue(':libelle', $responsabilite->$libelle);
        $reqInsRes->execute();
    }

    /**
     * Insertion d'une salle en base de données.
     *
     * @param $salle La salle à insérer dans la base de données.
    */
    public function insertSalle($salle)
    {
        // Remplis la table Salle
        $reqInsMat = $this->db->prepare("INSERT INTO salle (libelle)
            VALUES (:libelle)");
        $reqInsMat->bindValue(':libelle', $salle->$libelle);
        $reqInsMat->execute();
    }

    //----------UPDATE----------\\

    //----------DELETE----------\\

    //----------SELECT----------\\

    /**
     * Vérification de l'existance d'un utilisateur dans la base de donnée.
     *
     * @param $login Le login de l'utilisateur recherché.
     * @param $password Le mot de passe de l'utilisateur recherché.
     * @return informations/-1 Renvoie les informations utiles de l'utilisateur ou -1 si on ne trouve pas d'utilisateur correspondant.
     */
    public function checkUser($login, $password)
    {
        $reqCheckUser = $this->db->prepare("select nom, prenom, id_responsabilite from personnel where login = ? and mdp = ?");
        if ($reqCheckUser->execute(array($login, $password))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            while ($ligne=$reqCheckUser->fetch()) {
                // On renvoit les infos de l'utilisateur (nom, prénom, responsabilité)
                return [$ligne["nom"], $ligne["prenom"], $ligne["id_responsabilite"]];
            }
        }
        return -1;
    }
}
