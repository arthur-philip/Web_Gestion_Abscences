<?php
/**
 * Classe qui contient toutes les fonctions dont le site a besoin pour utiliser la base de données.
 *
 * @author thibault.kuzmycz, jordan.pedrero, arthur.philip
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

    public function getDB()
    {
        return $this->db;
    }
    
    //----------INSERT----------\\

    /**
     * Insertion d'une abscence en base de données.
     *
     * @param $abscence L'abscence à insérer dans la base de données.
    */
    public function insertAbscence($ine, $idCours)
    {
        // Remplis la table Abscence
        $reqInsAbs = $this->db->prepare("INSERT INTO abscence (id_cours, ine_etudiant) VALUES (:idCours, :ineEtudiant)");
        $reqInsAbs->bindValue(':idCours', $idCours);
        $reqInsAbs->bindValue(':ineEtudiant', $ine);
        $reqInsAbs->execute();
    }

    // TODO: anime
    
    /**
     * Insertion d'un cours en base de données.
     *
     * @param $cours Le cours à insérer dans la base de données.
    */
    public function insertCours(Cours $cours)
    {
        // Remplis la table Cours
        $reqCours = $this->db->prepare("INSERT INTO cours (id_matiere, numero_salle, horaire_debut, horaire_fin) VALUES (:idMatiere, :idSalle, :hDebut, :hFin)");
        $reqCours->bindValue(':idMatiere', $cours->getIdMatiere());
        $reqCours->bindValue(':idSalle', $cours->getIdSalle());
        $reqCours->bindValue(':hDebut', $cours->getHoraireDebut());
        $reqCours->bindValue(':hFin', $cours->getHoraireFin());
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

    // TODO: cours_groupe
    
    /**
     * Insertion d'un departement en base de données.
     *
     * @param $departement Le departement à insérer dans la base de données.
    */
    public function insertDepartement(Departement $departement)
    {
        // Remplis la table Departement
        $reqInsDept = $this->db->prepare("INSERT INTO departement (libelle) VALUES (:libelleDepart)");
        $reqInsDept->bindValue(':libelleDepart', $departement->getLibelle());
        $reqInsDept->execute();
    }

    /**
     * Insertion d'un étudiant en base de données.
     *
     * @param $etudiant L'étudiant à insérer dans la base de données.
    */
    public function insertEtudiant(Etudiant $etudiant, $requete)
    {
        // Remplis la table Etudiant
        $requete->bindValue(':ine_etudiant', $etudiant->getINE());
        $requete->bindValue(':nom', $etudiant->getNom());
        $requete->bindValue(':prenom', $etudiant->getPrenom());
        $requete->execute();
    }

    /**
     * Insertion d'une filiere en base de données.
     *
     * @param $filiere La filiere à insérer dans la base de données.
    */
    public function insertFiliere(Filiere $filiere)
    {
        // Remplis la table Filiere
        $reqInsFil = $this->db->prepare("INSERT INTO filiere (id_departement, libelle) VALUES (:idDepartement, :libelle)");
        $reqInsFil->bindValue(':idDepartement', $filiere->getIdDepartement());
        $reqInsFil->bindValue(':libelle', $filiere->getLibelle());
        $reqInsFil->execute();
    }

    /**
     * Insertion d'un groupe en base de données.
     *
     * @param $groupe Le groupe à insérer dans la base de données.
    */
    public function insertGroupe(Groupe $groupe)
    {
        // Remplis la table Groupe
        $reqInsGro = $this->db->prepare("INSERT INTO groupe (id_filiere, libelle) VALUES (:idFiliere, :libelle)");
        $reqInsGro->bindValue(':idFiliere', $groupe->getIdFiliere());
        $reqInsGro->bindValue(':libelle', $groupe->getLibelle());
        $reqInsGro->execute();
    }

    // TODO: groupe_etudiant

    /**
     * Insertion d'une matière en base de données.
     *
     * @param $matiere La matière à insérer dans la base de données.
    */
    public function insertMatiere(Matiere $matiere)
    {
        // Remplis la table Matiere
        $reqInsMat = $this->db->prepare("INSERT INTO matiere (libelle) VALUES (:libelle)");
        $reqInsMat->bindValue(':libelle', $matiere->getLibelle());
        $reqInsMat->execute();
    }

    /**
     * Insertion d'un membre du personnel en base de données.
     *
     * @param $personnel Le membre du personnel à insérer dans la base de données.
    */
    public function insertPersonnel(Personnel $personnel)
    {
        // Remplis la table Personnel
        $reqInsPer = $this->db->prepare("INSERT INTO personnel (login, mdp, nom, prenom, id_responsabilite) VALUES (:login, :mdp, :nom, :prenom, :idResponsabilite)");
        $reqInsPer->bindValue(':login', $personnel->getLogin());
        $reqInsPer->bindValue(':mdp', $personnel->getMdp());
        $reqInsPer->bindValue(':nom', $personnel->getNom());
        $reqInsPer->bindValue(':prenom', $personnel->getPrenom());
        $reqInsPer->bindValue(':idResponsabilite', $personnel->getIdResponsabilite());
        $reqInsPer->execute();
    }

    /**
     * Insertion d'une responsabilite en base de données.
     *
     * @param $responsabilite La responsabilite à insérer dans la base de données.
    */
    public function insertResponsabilite(Responsabilite $responsabilite)
    {
        // Remplis la table Responsabilite
        $reqInsRes = $this->db->prepare("INSERT INTO responsabilite (libelle) VALUES (:libelle)");
        $reqInsRes->bindValue(':libelle', $responsabilite->getLibelle());
        $reqInsRes->execute();
    }

    /**
     * Insertion d'une salle en base de données.
     *
     * @param $salle La salle à insérer dans la base de données.
    */
    public function insertSalle(Salle $salle)
    {
        // Remplis la table Salle
        $reqInsSal = $this->db->prepare("INSERT INTO salle (libelle) VALUES (:libelle)");
        $reqInsSal->bindValue(':libelle', $salle->getLibelle());
        $reqInsSal->execute();
    }

    //----------UPDATE----------\\

    /**
     * Mise à jour d'une abscence en base de données.
     *
     * @param $abscence L'abscence à mettre à jour dans la base de données.
    */
    public function updateAbscence(Abscence $abscence)
    {
        // Mise à jour de la table Abscence
        $reqUpdAbs = $this->db->prepare("UPDATE abscence SET id_cours = :idCours, ine_etudiant = :ineEtudiant WHERE id_abscence = :idAbscence");
        $reqUpdAbs->bindValue(':idAbscence', $abscence->getIdAbscence());
        $reqUpdAbs->bindValue(':idCours', $abscence->getIdAbscence());
        $reqUpdAbs->bindValue(':ineEtudiant', $abscence->getINE());
        $reqUpdAbs->execute();
    }

    //----------DELETE----------\\

    /**
     * Suppression d'une abscence en base de données.
     *
     * @param $abscence L'abscence à supprimer de la base de données.
    */
    public function deleteAbscence(Abscence $abscence)
    {
        // Mise à jour de la table Abscence
        $reqDelAbs = $this->db->prepare("DELETE FROM abscence WHERE id_abscence = :idAbscence");
        $reqDelAbs->bindValue(':idAbscence', $abscence->getIdAbscence());
        $reqDelAbs->execute();
    }

    //----------SELECT----------\\

    /**
     * Selection des abscences d'un étudiant de la base de données.
     *
     * @param $etudiant L'étudiant dont on cherche les abscences.
     * @return $data Tableau contenant toutes les abscences de l'étudiant.
    */
    public function selectAbscenceByEtudiant(Etudiant $etudiant)
    {
        $data = [];
        // Lecture la table Abscence
        $reqSAbsByEtu = $this->db->prepare("SELECT * FROM abscence WHERE ine_etudiant = ?");
        if ($reqSAbsByEtu->execute(array($etudiant->getINE()))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSAbsByEtu->fetch(); $cpt++) {
                $data[$cpt] = new Abscence($ligne["id_abscence"], $ligne["ine_etudiant"], $ligne["id_cours"]);
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les abscences de la base de données.
     *
     * @return $data Tableau contenant toutes les abscences.
    */
    public function selectAllAbscence()
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbs = $this->db->prepare("SELECT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                            FROM abscence abs, cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat 
                                            WHERE gro.id_groupe = cougro.id_groupe AND gro.id_groupe = groetu.id_groupe
                                            AND etu.ine_etudiant = groetu.ine_etudiant AND etu.ine_etudiant = abs.ine_etudiant
                                            AND cou.id_cours = cougro.id_cours AND cou.id_cours = abs.id_cours
                                            AND mat.id_matiere = cou.id_matiere");
        if ($reqSelAllAbs->execute()) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllAbs->fetch(); $cpt++) {
                $horaireFin = explode(" ", $ligne["horaire_fin"]);
                $data[$cpt] = [$ligne["nom"], $ligne["prenom"], $ligne["libelle"], $ligne["horaire_debut"], $horaireFin[1]];
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les abscences d'un groupe dans la base de données.
     *
     * @param $idGroupe L'id du groupe dont on recherche les abscences.
     * @return $data Tableau contenant toutes les abscences du groupe.
    */
    public function selectAllAbscenceByGroupe($idGroupe)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbsByGro = $this->db->prepare("SELECT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                            FROM abscence abs, cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat 
                                            WHERE gro.id_groupe = cougro.id_groupe AND gro.id_groupe = groetu.id_groupe
                                            AND etu.ine_etudiant = groetu.ine_etudiant AND etu.ine_etudiant = abs.ine_etudiant
                                            AND cou.id_cours = cougro.id_cours AND cou.id_cours = abs.id_cours
                                            AND mat.id_matiere = cou.id_matiere
                                            AND cou.id_cours = ?");
        if ($reqSelAllAbsByGro->execute(array($idGroupe))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllAbsByGro->fetch(); $cpt++) {
                $horaireFin = explode(" ", $ligne["horaire_fin"]);
                $data[$cpt] = [$ligne["nom"], $ligne["prenom"], $ligne["libelle"], $ligne["horaire_debut"], $horaireFin[1]];
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les abscences d'une filière dans la base de données.
     *
     * @param $idFiliere L'id de la filière dont on recherche les abscences.
     * @return $data Tableau contenant toutes les abscences de la filière.
    */
    public function selectAllAbscenceByFilere($idFiliere)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbsByFil = $this->db->prepare("SELECT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                            FROM abscence abs, cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat 
                                            WHERE gro.id_groupe = cougro.id_groupe AND gro.id_groupe = groetu.id_groupe
                                            AND etu.ine_etudiant = groetu.ine_etudiant AND etu.ine_etudiant = abs.ine_etudiant
                                            AND cou.id_cours = cougro.id_cours AND cou.id_cours = abs.id_cours
                                            AND mat.id_matiere = cou.id_matiere
                                            AND gro.id_filiere = ?");
        if ($reqSelAllAbsByFil->execute(array($idFiliere))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllAbsByFil->fetch(); $cpt++) {
                $horaireFin = explode(" ", $ligne["horaire_fin"]);
                $data[$cpt] = [$ligne["nom"], $ligne["prenom"], $ligne["libelle"], $ligne["horaire_debut"], $horaireFin[1]];
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les abscences d'un département dans la base de données.
     *
     * @param $idDepartement L'id du département dont on recherche les abscences.
     * @return $data Tableau contenant toutes les abscences du département.
    */
    public function selectAllAbscenceByDepartement($idDepartement)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbsByDep = $this->db->prepare("SELECT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                            FROM abscence abs, cours cou, cours_groupe cougro, etudiant etu, filiere fil, groupe gro, groupe_etudiant groetu, matiere mat 
                                            WHERE gro.id_groupe = cougro.id_groupe AND gro.id_groupe = groetu.id_groupe
                                            AND etu.ine_etudiant = groetu.ine_etudiant AND etu.ine_etudiant = abs.ine_etudiant
                                            AND cou.id_cours = cougro.id_cours AND cou.id_cours = abs.id_cours
                                            AND mat.id_matiere = cou.id_matiere
                                            AND gro.id_filiere = fil.id_filiere AND fil.id_departement = ?");
        if ($reqSelAllAbsByDep->execute(array($idDepartement))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllAbsByDep->fetch(); $cpt++) {
                $horaireFin = explode(" ", $ligne["horaire_fin"]);
                $data[$cpt] = [$ligne["nom"], $ligne["prenom"], $ligne["libelle"], $ligne["horaire_debut"], $horaireFin[1]];
            }
        }
        return $data;
    }

    /**
     * Selection de tous les cours dans la base de données.
     *
     * @param $idEtudiant L'étudiant dont on souhaite connaître les cours.
     * @return $data Tableau contenant tous les cours.
    */
    public function selectAllCoursByEtudiant($nomEtudiant, $prenomEtudiant)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllCouByEtu = $this->db->prepare("SELECT mat.libelle, sal.libelle, cou.horaire_debut, cou.horaire_fin , cou.id_cours
                                                FROM cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat, salle sal
                                                WHERE cou.id_matiere = mat.id_matiere AND cou.id_salle = sal.id_salle AND cou.id_cours = cougro.id_cours
                                                AND gro.id_groupe = cougro.id_groupe AND gro.id_groupe = groetu.id_groupe
                                                AND etu.ine_etudiant = groetu.ine_etudiant AND etu.nom = ? AND etu.prenom = ? ");
        if ($reqSelAllCouByEtu->execute(array($nomEtudiant, $prenomEtudiant))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllCouByEtu->fetch(); $cpt++) {
                $horaireFin = explode(" ", $ligne["horaire_fin"]);
                $data[$cpt] = [$ligne[0], $ligne[1], $ligne["horaire_debut"], $horaireFin[1], $ligne["id_cours"]];
            }
        }
        return $data;
    }

    /**
     * Selection de touts les départements de la base de données.
     *
     * @return $data Tableau contenant toutes les abscences.
    */
    public function selectAllDepartement()
    {
        $data = [];
        // Lecture la table Departement
        $reqSelAllDep = $this->db->prepare("SELECT * FROM departement");
        if ($reqSelAllDep->execute()) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllDep->fetch(); $cpt++) {
                $data[$cpt] = new Departement($ligne["id_departement"], $ligne["libelle"]);
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les filières d'un département en base de données.
     *
     * @param $departement Le département dont on cherche les filières.
     * @return $data Tableau contenant toutes les filières du département.
    */
    public function selectEtudiantByNomPrenom($nom, $prenom)
    {
        // Lecture la table Etudiant
        $reqSelAllFilByDep = $this->db->prepare("SELECT * FROM etudiant WHERE nom = ? AND prenom = ?");
        if ($reqSelAllFilByDep->execute(array($nom, $prenom))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllFilByDep->fetch(); $cpt++) {
                return [$ligne["ine_etudiant"], $ligne["nom"], $ligne["prenom"]];
            }
        }
        return -1;
    }

    /**
     * Selection de toutes les filières d'un département en base de données.
     *
     * @param $departement Le département dont on cherche les filières.
     * @return $data Tableau contenant toutes les filières du département.
    */
    public function selectAllFiliereByDepartement($departement)
    {
        $data = [];
        // Lecture la table Filiere
        $reqSelAllFilByDep = $this->db->prepare("SELECT * FROM filiere WHERE id_departement = ?");
        if ($reqSelAllFilByDep->execute(array($departement))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllFilByDep->fetch(); $cpt++) {
                $data[$cpt] = new Filiere($ligne["id_filiere"], $ligne["id_departement"], $ligne["libelle"]);
            }
        }
        return $data;
    }

    /**
     * Selection de tous les groupes d'une filière en base de données.
     *
     * @param $filiere La filière dont on cherche les groupes.
     * @return $data Tableau contenant touts les groupes de la filière.
    */
    public function selectAllGroupeByFiliere($filiere)
    {
        //$data = [];
        // Lecture la table Groupe
        $reqSelAllGroByFil = $this->db->prepare("SELECT * FROM groupe WHERE id_filiere = ?");
        if ($reqSelAllGroByFil->execute(array($filiere))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllGroByFil->fetch(); $cpt++) {
                //$data[$cpt] = new Groupe($ligne["id_groupe"], $ligne["id_filiere"], $ligne["libelle"]);
                $data[$cpt] = [$ligne["id_groupe"], $ligne["id_filiere"], $ligne["libelle"]];
            }
        }
        return $data;
    }

    /**
     * Selection d'un membre du personnel dans la base de données en utilisant son login.
     *
     * @param $personnel Le membre du personnel recherché.
     * @return Personnel/null Renvoie toutes les données du membre du personnel si il existe déjà, null sinon.
    */
    public function selectPersonnelByLogin(Personnel $personnel)
    {
        // Lecture de la table Personnel
        $reqSelPer = $this->db->prepare("SELECT * FROM personnel WHERE login = ?");
        if ($reqSelPer->execute(array($personnel->getLogin()))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            while ($ligne=$reqSelPer->fetch()) {
                return new Personnel($ligne["id_personnel"], $ligne["login"], $ligne["mdp"], $ligne["nom"], $ligne["prenom"], $ligne["id_responsabilite"]);
            }
        }
        return null;
    }

    //----------AUTRES----------\\

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
