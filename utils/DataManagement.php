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
        $this->db = new PDO('mysql:host=localhost;dbname=gestion_eleve;charset=utf8', $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		//$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    public function getDB()
    {
        return $this->db;
    }
    
    //----------INSERT----------\\

    /**
     * Insertion d'une absence en base de données.
     *
     * @param $absence L'absence à insérer dans la base de données.
    */
    public function insertAbsence($ine, $idCours)
    {
        // Remplis la table Absence
        $reqInsAbs = $this->db->prepare("INSERT INTO absence (id_cours, ine_etudiant) VALUES (:idCours, :ineEtudiant)");
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
        $reqCours = $this->db->prepare("INSERT INTO cours (id_matiere, id_salle, horaire_debut, horaire_fin) VALUES (:idMatiere, :idSalle, :hDebut, :hFin)");
        $reqCours->bindValue(':idMatiere', $cours->getIdMatiere());
        $reqCours->bindValue(':idSalle', $cours->getIdSalle());
		
		$hdeb = $cours->getHoraireDebut()->format('Y-m-d H:i:s');
		$hfin = $cours->getHoraireFin()->format('Y-m-d H:i:s');
		
        $reqCours->bindParam(':hDebut', $hdeb);
        $reqCours->bindParam(':hFin', $hfin);
        $reqCours->execute();
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
    public function insertEtudiant(Etudiant $etudiant)
    {
        // Remplis la table Etudiant
		$reqInsEtu = $this->db->prepare("INSERT INTO etudiant (ine_etudiant,nom,prenom) VALUES (:ine_etudiant,:nom,:prenom)");
        $reqInsEtu->bindValue(':ine_etudiant', $etudiant->getINE());
        $reqInsEtu->bindValue(':nom', $etudiant->getNom());
        $reqInsEtu->bindValue(':prenom', $etudiant->getPrenom());
        $reqInsEtu->execute();
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
     * Insertion d'une filiere en base de données.
     *
     * @param $filiere La filiere à insérer dans la base de données.
    */
    public function insertFiliereSansDep($libelleFiliere)
    {
		// Remplis la table Filiere
        $reqInsFilSD = $this->db->prepare("INSERT INTO filiere (libelle) VALUES (:libelle)");
        $reqInsFilSD->bindValue(':libelle', $libelleFiliere);
        $reqInsFilSD->execute();
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

	/**
     * Insertion d'un groupe_etudiant en base de données.
     *
     * @param $groupe_etudiant Le groupe_etudiant à insérer dans la base de données.
    */
    public function insertGroupe_etudiant(Groupe_etudiant $groupe)
    {
		
        // Remplis la table Groupe
        $reqInsGroEtu = $this->db->prepare("INSERT INTO groupe_etudiant (id_groupe, ine_etudiant) VALUES (:id_groupe, :ine_etudiant)");
        $reqInsGroEtu->bindValue(':id_groupe', $groupe->getIdGroupe());
		$reqInsGroEtu->bindValue(':ine_etudiant', $groupe->getIneEtudiant());
		$reqInsGroEtu->execute();
    }

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

		
		if(trim($salle->getDesc_salle()) != ""){
			if(trim($salle->getLibelle()) != ""){
				$query = "INSERT INTO salle (libelle, desc_salle) VALUES (:libelle, :desc_salle)";
				$reqInsSal = $this->db->prepare($query);
				$reqInsSal->bindValue(':libelle', $salle->getLibelle());
				$reqInsSal->bindValue(':desc_salle', $salle->getDesc_salle());
				$reqInsSal->execute();
			}
			
		} else {
			if(trim($salle->getLibelle()) != ""){
				$query = "INSERT INTO salle (libelle) VALUES (:libelle)";
				$reqInsSal = $this->db->prepare($query);
				$reqInsSal->bindValue(':libelle', $salle->getLibelle());
				$reqInsSal->execute();
			}
		}
    }

	/**
     * Insertion d'un Anime en base de données.
     *
     * @param $Anime L'anime à insérer dans la base de données.
    */
    public function insertAnime(Anime $anime)
    {
        // Remplis la table Departement
        $reqInsAnime = $this->db->prepare("INSERT INTO anime (id_cours, id_personnel) VALUES (:id_cours, :id_personnel)");
        $reqInsAnime->bindValue(':id_cours', $anime->getIdCours());
		$reqInsAnime->bindValue(':id_personnel', $anime->getIdPersonnel());
        $reqInsAnime->execute();
    }

	/**
     * Insertion d'un Anime en base de données.
     *
     * @param $Anime L'anime à insérer dans la base de données.
    */
    public function insertCoursGroupe(CoursGroupe $coursGroupe)
    {
        // Remplis la table Departement
        $reqInsCoursGroupe = $this->db->prepare("INSERT INTO cours_groupe (id_cours, id_groupe) VALUES (:id_cours, :id_groupe)");
        $reqInsCoursGroupe->bindValue(':id_cours', $coursGroupe->getIdCours());
		$reqInsCoursGroupe->bindValue(':id_groupe', $coursGroupe->getIdGroupe());
        $reqInsCoursGroupe->execute();
    }
	
    //----------UPDATE----------\\

    /**
     * Mise à jour d'une absence en base de données.
     *
     * @param $absence L'absence à mettre à jour dans la base de données.
    */
    public function updateAbsence(Absence $absence)
    {
        // Mise à jour de la table Absence
        $reqUpdAbs = $this->db->prepare("UPDATE absence SET id_cours = :idCours, ine_etudiant = :ineEtudiant WHERE id_absence = :idAbsence");
        $reqUpdAbs->bindValue(':idAbsence', $absence->getIdAbsence());
        $reqUpdAbs->bindValue(':idCours', $absence->getIdAbsence());
        $reqUpdAbs->bindValue(':ineEtudiant', $absence->getINE());
        $reqUpdAbs->execute();
    }

    //----------DELETE----------\\

    /**
     * Suppression d'une absence en base de données.
     *
     * @param $absence L'absence à supprimer de la base de données.
    */
    public function deleteAbsence(Absence $absence)
    {
        // Mise à jour de la table Absence
        $reqDelAbs = $this->db->prepare("DELETE FROM absence WHERE id_absence = :idAbsence");
        $reqDelAbs->bindValue(':idAbsence', $absence->getIdAbsence());
        $reqDelAbs->execute();
    }

    //----------SELECT----------\\

	/**
     * Selection des ID des matieres dans la base de données en fonction d'un nom de matiere.
     *
     * @return $data id de la Matiere.
    */
    public function selectIdMatiere($nomMatiere)
    {
        // Lecture la table Matiere
        $reqSelIdMat = $this->db->prepare("SELECT id_matiere FROM matiere WHERE libelle=:nomMatiere");
		$reqSelIdMat->bindValue(':nomMatiere', $nomMatiere);
        $reqSelIdMat->execute();
		
		$dataIdMat = $reqSelIdMat->fetch();
           
        return $dataIdMat;
    }
	
	
	/**
     * Selection des un ID d'une salle dans la base de données en fonction d'un nom de salle.
     *
     * @return $data id de la salle rechercher
    */
    public function selectIdSalle($nomSalle)
    {
        // Lecture la table Salle
		$reqSelIdSalle = $this->db->prepare("SELECT id_salle FROM salle WHERE libelle=:nomSalle");
		$reqSelIdSalle->bindValue(':nomSalle', $nomSalle);
        $reqSelIdSalle->execute();
		
		$dataIdSalle = $reqSelIdSalle->fetch();
           
        return $dataIdSalle;
    }
	
	/**
     * Selection des ID des cours dans la base de données en fonction d'un nom de cours
     * @return $data id du cours
    */
    public function selectIdCours($idMatiere, $idSalle, $hDebut, $hFin)
    {
        // Lecture la table Cours
        $reqSelIdCours = $this->db->prepare("SELECT id_cours FROM cours WHERE id_matiere=:idMatiere and id_salle=:idSalle and horaire_debut=:hDebut and horaire_fin=:hFin");
		$reqSelIdCours->bindValue(':idMatiere', $idMatiere);
		$reqSelIdCours->bindValue(':idSalle', $idSalle);
		$reqSelIdCours->bindValue(':hDebut', $hDebut->format('Y-m-d H:i:s'));
		$reqSelIdCours->bindValue(':hFin', $hFin->format('Y-m-d H:i:s'));
        $reqSelIdCours->execute();
		
		$dataIdCours = $reqSelIdCours->fetch();
           
        return $dataIdCours;
    }
	
	/**
     * Selection des ID des personnel dans la base de données en fonction d'un login.
     *
     * @return $data id de du personnel.
    */
    public function selectIdPersonnel($login)
    {
        // Lecture la table personnel
        $reqSelIdPers = $this->db->prepare("SELECT id_personnel FROM personnel WHERE login=:login");
		$reqSelIdPers->bindValue(':login', $login);
        $reqSelIdPers->execute();
		
		$dataIdPers = $reqSelIdPers->fetch();
           
        return $dataIdPers;
    }
	
	/**
     * Selection des ID des filieres dans la base de données en fonction d'un libelle.
     *
     * @return $data id de la filiere.
    */
    public function selectIdFiliere($libelleFiliere)
    {
        // Lecture la table Matiere
        $reqSelIdFil = $this->db->prepare("SELECT id_filiere FROM filiere WHERE libelle=:libelleFiliere");
		$reqSelIdFil->bindValue(':libelleFiliere', $libelleFiliere);
        $reqSelIdFil->execute();
		
		$dataIdFil = $reqSelIdFil->fetch();
           
        return $dataIdFil;
    }
	
	/**
     * Selection des ID des groupe dans la base de données en fonction d'un nom de groupe.
     *
     * @return $data id du groupe.
    */
    public function selectIdGroupe($nomGroupe)
    {
        // Lecture la table Matiere
        $reqSelIdGrp = $this->db->prepare("SELECT id_groupe FROM groupe WHERE libelle=:nomGroupe");
		$reqSelIdGrp->bindValue(':nomGroupe', $nomGroupe);
        $reqSelIdGrp->execute();
		
		$dataIdGrp = $reqSelIdGrp->fetch();
           
        return $dataIdGrp;
    }
	
	
    /**
     * Selection des absences d'un étudiant de la base de données.
     *
     * @param $etudiant L'étudiant dont on cherche les absences.
     * @return $data Tableau contenant toutes les absences de l'étudiant.
    */
    public function selectAbsenceByEtudiant(Etudiant $etudiant)
    {
        $data = [];
        // Lecture la table Absence
        $reqSAbsByEtu = $this->db->prepare("SELECT DISTINCT * FROM absence WHERE ine_etudiant = ?");
        if ($reqSAbsByEtu->execute(array($etudiant->getINE()))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSAbsByEtu->fetch(); $cpt++) {
                $data[$cpt] = new Absence($ligne["id_absence"], $ligne["ine_etudiant"], $ligne["id_cours"]);
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les absences de la base de données.
     *
     * @return $data Tableau contenant toutes les absences.
    */
    public function selectAllAbsence()
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbs = $this->db->prepare("SELECT DISTINCT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                            FROM absence abs, cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat 
                                            WHERE gro.id_groupe = cougro.id_groupe 
                                            AND gro.id_groupe = groetu.id_groupe
                                            AND etu.ine_etudiant = groetu.ine_etudiant 
                                            AND etu.ine_etudiant = abs.ine_etudiant
                                            AND cou.id_cours = cougro.id_cours 
                                            AND cou.id_cours = abs.id_cours
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
     * Selection de toutes les absences d'un groupe dans la base de données.
     *
     * @param $idGroupe L'id du groupe dont on recherche les absences.
     * @return $data Tableau contenant toutes les absences du groupe.
    */
    public function selectAllAbsenceByGroupe($idGroupe)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbsByGro = $this->db->prepare("SELECT DISTINCT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                                FROM absence abs, cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat 
                                                WHERE gro.id_groupe = cougro.id_groupe 
                                                AND gro.id_groupe = groetu.id_groupe
                                                AND etu.ine_etudiant = groetu.ine_etudiant 
                                                AND etu.ine_etudiant = abs.ine_etudiant
                                                AND cou.id_cours = cougro.id_cours 
                                                AND cou.id_cours = abs.id_cours
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
     * Selection de toutes les absences d'une filière dans la base de données.
     *
     * @param $idFiliere L'id de la filière dont on recherche les absences.
     * @return $data Tableau contenant toutes les absences de la filière.
    */
    public function selectAllAbsenceByFilere($idFiliere)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbsByFil = $this->db->prepare("SELECT DISTINCT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                                FROM absence abs, cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat 
                                                WHERE gro.id_groupe = cougro.id_groupe 
                                                AND gro.id_groupe = groetu.id_groupe
                                                AND etu.ine_etudiant = groetu.ine_etudiant 
                                                AND etu.ine_etudiant = abs.ine_etudiant
                                                AND cou.id_cours = cougro.id_cours 
                                                AND cou.id_cours = abs.id_cours
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
     * Selection de toutes les absences d'un département dans la base de données.
     *
     * @param $idDepartement L'id du département dont on recherche les absences.
     * @return $data Tableau contenant toutes les absences du département.
    */
    public function selectAllAbsenceByDepartement($idDepartement)
    {
        $data = [];
        // Lecture des tables
        $reqSelAllAbsByDep = $this->db->prepare("SELECT DISTINCT etu.nom, etu.prenom, mat.libelle, cou.horaire_debut, cou.horaire_fin 
                                                FROM absence abs, cours cou, cours_groupe cougro, etudiant etu, filiere fil, groupe gro, groupe_etudiant groetu, matiere mat 
                                                WHERE gro.id_groupe = cougro.id_groupe 
                                                AND gro.id_groupe = groetu.id_groupe
                                                AND etu.ine_etudiant = groetu.ine_etudiant 
                                                AND etu.ine_etudiant = abs.ine_etudiant
                                                AND cou.id_cours = cougro.id_cours 
                                                AND cou.id_cours = abs.id_cours
                                                AND mat.id_matiere = cou.id_matiere
                                                AND gro.id_filiere = fil.id_filiere 
                                                AND fil.id_departement = ?");
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
        $reqSelAllCouByEtu = $this->db->prepare("SELECT DISTINCT mat.libelle, sal.libelle, cou.horaire_debut, cou.horaire_fin , cou.id_cours
                                                FROM cours cou, cours_groupe cougro, etudiant etu, groupe gro, groupe_etudiant groetu, matiere mat, salle sal
                                                WHERE cou.id_matiere = mat.id_matiere 
                                                AND cou.id_salle = sal.id_salle 
                                                AND cou.id_cours = cougro.id_cours
                                                AND gro.id_groupe = cougro.id_groupe 
                                                AND gro.id_groupe = groetu.id_groupe
                                                AND etu.ine_etudiant = groetu.ine_etudiant 
                                                AND etu.nom = ? 
                                                AND etu.prenom = ? ");
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
     * Selection de tous les départements de la base de données.
     *
     * @return $data Tableau contenant toutes les absences.
    */
    public function selectAllDepartement()
    {
        $data = [];
        // Lecture la table Departement
        $reqSelAllDep = $this->db->prepare("SELECT DISTINCT * FROM departement");
        if ($reqSelAllDep->execute()) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllDep->fetch(); $cpt++) {
                $data[$cpt] = new Departement($ligne["id_departement"], $ligne["libelle"]);
            }
        }
        return $data;
    }

    /**
     * Selection de tous les étudiants de la base de données.
     *
     * @return $data Tableau contenant tous les étudiants.
    */
    public function selectAllEtudiant()
    {
        $data = [];
        // Lecture la table Departement
        $reqSelAllEtu = $this->db->prepare("SELECT DISTINCT ine_etudiant, nom, prenom FROM etudiant");
        if ($reqSelAllEtu->execute()) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllEtu->fetch(); $cpt++) {
                $data[$cpt] = new Etudiant($ligne["ine_etudiant"], $ligne["nom"], $ligne["prenom"]);
            }
        }
        return $data;
    }

    /**
     * Selection de tous les étudiants d'un groupe dans la base de données.
     *
     * @return $data Tableau contenant tous les étudiants d'un groupe.
    */
    public function selectAllEtudiantByGroupe($idGroupe)
    {
        $data = [];
        // Lecture la table Etudiant
        $reqSelAllEtuByGro = $this->db->prepare("SELECT DISTINCT etu.ine_etudiant, etu.nom, etu.prenom 
                                            FROM etudiant etu, groupe gro, groupe_etudiant groetu
                                            WHERE etu.ine_etudiant = groetu.ine_etudiant
                                            AND gro.id_groupe = groetu.id_groupe 
                                            AND gro.id_groupe = ?");
        if ($reqSelAllEtuByGro->execute(array($idGroupe))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllEtuByGro->fetch(); $cpt++) {
                $data[$cpt] = new Etudiant($ligne["ine_etudiant"], $ligne["nom"], $ligne["prenom"]);
            }
        }
        return $data;
    }

    /**
     * Selection de tous les étudiants d'une filière dans la base de données.
     *
     * @return $data Tableau contenant tous les étudiants d'une filière.
    */
    public function selectAllEtudiantByFiliere($idFiliere)
    {
        $data = [];
        // Lecture la table Etudiant
        $reqSelAllEtuByFil = $this->db->prepare("SELECT DISTINCT etu.ine_etudiant, etu.nom, etu.prenom 
                                            FROM etudiant etu, groupe gro, groupe_etudiant groetu
                                            WHERE etu.ine_etudiant = groetu.ine_etudiant
                                            AND gro.id_groupe = groetu.id_groupe 
                                            AND gro.id_filiere = ?");
        if ($reqSelAllEtuByFil->execute(array($idFiliere))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllEtuByFil->fetch(); $cpt++) {
                $data[$cpt] = new Etudiant($ligne["ine_etudiant"], $ligne["nom"], $ligne["prenom"]);
            }
        }
        return $data;
    }

    /**
     * Selection de tous les étudiants d'un département dans la base de données.
     *
     * @return $data Tableau contenant tous les étudiants du département.
    */
    public function selectAllEtudiantByDepartement($idDepartement)
    {
        $data = [];
        // Lecture la table Etudiant
        $reqSelAllEtuByDep = $this->db->prepare("SELECT DISTINCT etu.ine_etudiant, etu.nom, etu.prenom 
                                            FROM etudiant etu, filiere fil, groupe gro, groupe_etudiant groetu
                                            WHERE etu.ine_etudiant = groetu.ine_etudiant
                                            AND gro.id_groupe = groetu.id_groupe 
                                            AND gro.id_filiere = fil.id_filiere
                                            AND fil.id_departement = ?");
        if ($reqSelAllEtuByDep->execute(array($idDepartement))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllEtuByDep->fetch(); $cpt++) {
                $data[$cpt] = new Etudiant($ligne["ine_etudiant"], $ligne["nom"], $ligne["prenom"]);
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
        $reqSelAllFilByDep = $this->db->prepare("SELECT DISTINCT * FROM etudiant WHERE nom = ? AND prenom = ?");
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
        $reqSelAllFilByDep = $this->db->prepare("SELECT DISTINCT * FROM filiere WHERE id_departement = ?");
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
        $data = [];
        // Lecture la table Groupe
        $reqSelAllGroByFil = $this->db->prepare("SELECT DISTINCT * FROM groupe WHERE id_filiere = ?");
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
     * Selection de toutes les matières de la base de données.
     *
     * @return $data Tableau contenant toutes les matières.
    */
    public function selectAllMatiere()
    {
        $data = [];
        // Lecture la table Matiere
        $reqSelAllMat = $this->db->prepare("SELECT DISTINCT id_matiere, libelle FROM matiere");
        if ($reqSelAllMat->execute()) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllMat->fetch(); $cpt++) {
                $data[$cpt] = new Matiere($ligne["id_matiere"], $ligne["libelle"]);
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les matières d'une filière dans la base de données.
     *
     * @return $data Tableau contenant toutes les matières d'une filière.
    */
    public function selectAllMatiereByFiliere($idFiliere)
    {
        $data = [];
        // Lecture la table Matiere
        $reqSelAllMat = $this->db->prepare("SELECT DISTINCT mat.id_matiere, mat.libelle
                                            FROM cours cou, cours_groupe cougro, groupe gro, matiere mat
                                            WHERE cou.id_matiere = mat.id_matiere 
                                            AND cou.id_cours = cougro.id_cours
                                            AND gro.id_groupe = cougro.id_groupe 
                                            AND gro.id_filiere = ?");
        if ($reqSelAllMat->execute(array($idFiliere))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllMat->fetch(); $cpt++) {
                $data[$cpt] = new Matiere($ligne["id_matiere"], $ligne["libelle"]);
            }
        }
        return $data;
    }

    /**
     * Selection de toutes les matières d'un département dans la base de données.
     *
     * @return $data Tableau contenant toutes les matières d'un département.
    */
    public function selectAllMatiereByDepartement($idDepartement)
    {
        $data = [];
        // Lecture la table Matiere
        $reqSelAllMat = $this->db->prepare("SELECT DISTINCT mat.id_matiere, mat.libelle
                                            FROM cours cou, cours_groupe cougro, filiere fil, groupe gro, matiere mat
                                            WHERE cou.id_matiere = mat.id_matiere 
                                            AND cou.id_cours = cougro.id_cours
                                            AND gro.id_groupe = cougro.id_groupe 
                                            AND gro.id_filiere = fil.id_filiere
                                            AND fil.id_departement = ?");
        if ($reqSelAllMat->execute(array($idDepartement))) {
            // Si les informations sont correctes (au moins un résultat trouvé)
            for ($cpt=0; $ligne=$reqSelAllMat->fetch(); $cpt++) {
                $data[$cpt] = new Matiere($ligne["id_matiere"], $ligne["libelle"]);
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
        $reqSelPer = $this->db->prepare("SELECT DISTINCT * FROM personnel WHERE login = ?");
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
        $reqCheckUser = $this->db->prepare("SELECT DISTINCT nom, prenom, id_responsabilite FROM personnel WHERE login = ? and mdp = ?");
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
