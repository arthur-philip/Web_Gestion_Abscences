<?php

    // Formulaire de création d'un professeur.
    if (isset($_POST['createProf_login']) && isset($_POST['createProf_mdp']) && isset($_POST['createProf_nom']) && isset($_POST['createProf_prenom'])) {

        // Récupération des informations du formulaire.
        $createProf_login = htmlspecialchars($_POST['createProf_login']);
        $createProf_mdp = htmlspecialchars($_POST['createProf_mdp']);
        $createProf_nom = htmlspecialchars($_POST['createProf_nom']);
        $createProf_prenom = htmlspecialchars($_POST['createProf_prenom']);

        // Création d'un nouveau membre du personnel avec ces informations.
        $newPerso = new Personnel(null, $createProf_login, $createProf_mdp, $createProf_nom, $createProf_prenom, $resp_professeur);

        // On vérifie que ce login n'est pas déjà utilisé.
        try {
            // On cherche en base de données.
            $exist = $dataManagement->selectPersonnelByLogin($newPerso);
        } catch (Exception $e) {
            // si probleme -> affiche une erreur et sort de la boucle.
            echo "<script>alert('Erreur lors de la vérification de l'existance du personnel professeur.');</script>";
            exit;
        }
        if ($exist == null) {
            // Insérer le personnel en base de donnée.
            try {
                $dataManagement->insertPersonnel($newPerso);
            } catch (Exception $e) {
                // Si probleme -> affiche une erreur et sort de la boucle.
                echo "<script>alert('Erreur lors de la création du personnel professeur.');</script>";
                exit;
            }
            // Afficher un message confirmant l'insertion et vider les valeurs du formulaire.
            echo "<script>alert('Création du personnel professeur réussie.');</script>";
            $createProf_login = "";
            $createProf_mdp = "";
            $createProf_nom = "";
            $createProf_prenom = "";
            $_POST = array();
        } else {
            // On affiche une erreur.
            echo "<script>alert('Ce login est déjà utilisé, veuillez en choisir un autre.');</script>";
        }
    }

    // Formulaire de création d'un département.
    if (isset($_POST['createDepart_nom'])) {
        
        // Récupération des informations du formulaire.
        $createDepart_nom = htmlspecialchars($_POST['createDepart_nom']);

        // Création d'un nouveau département avec ces informations.
        $newDepart = new Departement(null, $createDepart_nom);

        // Insérer le département en base de donnée.
        try {
            $dataManagement->insertDepartement($newDepart);
        } catch (Exception $e) {
            // Si probleme -> affiche une erreur et sort de la boucle.
            echo "<script>alert('Erreur lors de la création du département.');</script>";
            exit;
        }
        // Afficher un message confirmant l'insertion et vider les valeurs du formulaire.
        echo "<script>alert('Création du département réussie.');</script>";
        $createDepart_nom = "";
        $_POST = array();
    }

    // Formulaire de création d'une filière.
    if (isset($_POST['createFiliere_nom']) && isset($_POST['createFiliere_dep'])) {

        // Récupération des informations du formulaire.
        $createFiliere_nom = htmlspecialchars($_POST['createFiliere_nom']);
        $createFiliere_dep = htmlspecialchars($_POST['createFiliere_dep']);

        // Création d'une nouvelle filière avec ces informations.
        $newFillere = new Filiere(null, $createFiliere_dep, $createFiliere_nom);

        // Insérer le personnel en base de donnée.
        try {
            $dataManagement->insertFiliere($newFillere);
        } catch (Exception $e) {
            // Si probleme -> affiche une erreur et sort de la boucle.
            echo "<script>alert('Erreur lors de la création de la filière.');</script>";
            exit;
        }
        // Afficher un message confirmant l'insertion et vider les valeurs du formulaire.
        echo "<script>alert('Création de la filière réussie.');</script>";
        $createFiliere_nom = "";
        $createFiliere_dep = "";
        $_POST = array();
    }

    // Formulaire d'affichage des étudiants en fonction du département, de la filière et du groupe.
    if (isset($_POST['listeEtudiant_dept']) && trim($_POST['listeEtudiant_dept']) != "") {
        
        // On prend l'id du département choisi.
        $Etudiant_idDepartement = htmlspecialchars($_POST['listeEtudiant_dept']);

        // Si une filière a étée choisie préalablement.
        if (isset($_POST['listeEtudiant_filiere']) && trim($_POST['listeEtudiant_filiere']) != "") {

            // On prend l'id de la filiere choisie.
            $Etudiant_idFiliere = htmlspecialchars($_POST['listeEtudiant_filiere']);

            if (isset($_POST['listeEtudiant_groupe']) && trim($_POST['listeEtudiant_groupe']) != "") {

                // On prend l'id du groupe choisi.
                $Etudiant_idGroupe = htmlspecialchars($_POST['listeEtudiant_groupe']);
            }
        }
    }

    // Formulaire d'affichage des matières en fonction du département et de la filière.
    if (isset($_POST['listeMatiere_dept']) && trim($_POST['listeMatiere_dept']) != "") {
        
        // On prend l'id du département choisi.
        $Matiere_idDepartement = htmlspecialchars($_POST['listeMatiere_dept']);

        // Si une filière a étée choisie préalablement.
        if (isset($_POST['listeMatiere_filiere']) && trim($_POST['listeMatiere_filiere']) != "") {

            // On prend l'id de la filiere choisie.
            $Matiere_idFiliere = htmlspecialchars($_POST['listeMatiere_filiere']);
        }
    }
?>
<section>
    <?php
    // TODO:
        // Importation des étudiants
        // Importation des plannings (Filière par filière)
        // Suppression d’un planning (Filière par filière)
    ?>
    <h2 class="toggleNext">Panel administratif</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-3">
            <form id="leFormulaire" method="POST" action="index">
                <h3>Création d'un professeur</h3>
                <p>Login</p>
                <input type="text" name="createProf_login" value="<?php if (isset($createProf_login)) {
                    echo $createProf_login;
                } ?>" required>
                <p>Mot de passe</p>
                <input type="password" name="createProf_mdp" value="<?php if (isset($createProf_mdp)) {
                    echo $createProf_mdp;
                } ?>" required>
                <p>Nom</p>
                <input type="text" name="createProf_nom" value="<?php if (isset($createProf_nom)) {
                    echo $createProf_nom;
                } ?>">
                <p>Prenom</p>
                <p><input type="text" name="createProf_prenom" value="<?php if (isset($createProf_prenom)) {
                    echo $createProf_prenom;
                } ?>"></p>
                <input class="myButton" type="submit" value="Créer">
            </form>
        </div>
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-3">
            <form id="leFormulaire" method="POST" action="index">
                <h3>Création d'un département</h3>
                <p>Nom</p>
                <p><input type="text" name="createDepart_nom" value="<?php if (isset($createDepart_nom)) {
                    echo $createDepart_nom;
                } ?>"  required></p>
                <input class="myButton" type="submit" value="Créer">
            </form>
        </div>
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-3">
            <form id="leFormulaire" method="POST" action="index">
                <h3>Création d'une filière</h3>
                <p>Nom</p>
                <input type="text" name="createFiliere_nom" value="<?php if (isset($createFiliere_nom)) {
                    echo $createFiliere_nom;
                } ?>" required>
                <p>Département</p>
                <p><select name="createFiliere_dep" required>
                    <?php

                        // On récupére tous les départements.
                        $departements = $dataManagement->selectAllDepartement();
                        
                        // On crée une option pour chacun d'eux (avec son id en value).
                        foreach ($departements as $dept) {
                            if (isset($createFiliere_dep) && $dept->getIdDepartement() == $createFiliere_dep) {
                                print("<option selected='selected' value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            } else {
                                print("<option value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }
                        }
                    ?>
                </select></p>
                <input class="myButton" type="submit" value="Créer">
            </form>
        </div>
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-3">
            <h3>Importations des étudiants et des plannings + suppression d'un planning</h3>
        </div>
        <div class="col-12 col-xl-7">
            <form id="leFormulaire" method="POST" action="index">
                <h3>Liste des étudiants</h3>
                Département :
                <select name="listeEtudiant_dept">
                    <option value=""></option>
                    <?php
                        // On récupére tous les départements.
                        $departements = $dataManagement->selectAllDepartement();
                        
                        // On crée une option pour chacun d'eux (avec son id en value).
                        foreach ($departements as $dept) {
                            if (isset($Etudiant_idDepartement) && $dept->getIdDepartement() == $Etudiant_idDepartement) {
                                print("<option selected='selected' value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            } else {
                                print("<option value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }
                        }
                    ?>
                </select>
                Filière :
                <select name="listeEtudiant_filiere">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi un département.
                        if (isset($Etudiant_idDepartement)) {
                            // On récupère la liste des filières de ce département.
                            $filieres = $dataManagement->selectAllFiliereByDepartement($Etudiant_idDepartement);
                            
                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($filieres as $fil) {
                                if (isset($Etudiant_idFiliere) && $fil->getIdFiliere() == $Etudiant_idFiliere) {
                                    print("<option selected='selected' value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                } else {
                                    print("<option value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                Groupe :
                <select name="listeEtudiant_groupe">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi une filière.
                        if (isset($Etudiant_idFiliere)) {

                            // On récupère la liste des groupes de cette filiere.
                            $groupes = $dataManagement->selectAllGroupeByFiliere($Etudiant_idFiliere);

                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($groupes as $groupe) {
                                if (isset($Etudiant_idGroupe) && $groupe[0] == $Etudiant_idGroupe) {
                                    print("<option selected='selected' value='".$groupe[0]."'>".$groupe[2]."</option>");
                                } else {
                                    print("<option value='".$groupe[0]."'>".$groupe[2]."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                <input class="myButton" type="submit" value="Rechercher">
            </form>
            <?php
                if (isset($_POST['listeEtudiant_etudiant']) || isset($_POST['listeEtudiant_dept']) || isset($_POST['listeEtudiant_filiere']) || isset($_POST['listeEtudiant_groupe'])) {
                    ?>
            <table class="table-fill">
                <thead>
                    <tr>
                        <td>INE</td>
                        <td>Nom</td>
                        <td>Prénom</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $etudiants = [];
                        // Si on n'a choisi qu'un département.
                        if (isset($Etudiant_idDepartement)) {
                            // Si on a aussi choisi une filière.
                            if (isset($Etudiant_idFiliere)) {
                                // Si on a aussi choisi un groupe.
                                if (isset($Etudiant_idGroupe)) {
                                    // On récupère les étudiants du groupe.
                                    $etudiants = $dataManagement->selectAllEtudiantByGroupe($Etudiant_idGroupe);
                                } else {
                                    // On récupère les étudiants de la filiere.
                                    $etudiants = $dataManagement->selectAllEtudiantByFiliere($Etudiant_idFiliere);
                                }
                            } else {
                                // On récupère les étudiants du département.
                                $etudiants = $dataManagement->selectAllEtudiantByDepartement($Etudiant_idDepartement);
                            }
                        } else {
                            // On récupère tous les étudiants.
                            $etudiants = $dataManagement->selectAllEtudiant();
                        }
                        // Afficher les étudiants.
                        foreach ($etudiants as $etudiant) {
                            print("<tr><td>".$etudiant->getINE()."</td><td>".$etudiant->getNom()."</td><td>".$etudiant->getPrenom()."</td></tr>");
                        }
                    ?>
                </tbody>
            </table>
            <?php
                } ?>
        </div>
        <div class="col-12 col-xl-5">
            <form id="leFormulaire" method="POST" action="index">
                <h3>Liste des matières</h3>
                Département :
                <select name="listeMatiere_dept">
                    <option value=""></option>
                    <?php
                        // On récupére tous les départements.
                        $departements = $dataManagement->selectAllDepartement();
                        
                        // On crée une option pour chacun d'eux (avec son id en value).
                        foreach ($departements as $dept) {
                            if (isset($Matiere_idDepartement) && $dept->getIdDepartement() == $Matiere_idDepartement) {
                                print("<option selected='selected' value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            } else {
                                print("<option value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }
                        }
                    ?>
                </select>
                Filière :
                <select name="listeMatiere_filiere">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi un département.
                        if (isset($Matiere_idDepartement)) {
                            // On récupère la liste des filières de ce département.
                            $filieres = $dataManagement->selectAllFiliereByDepartement($Matiere_idDepartement);
                            
                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($filieres as $fil) {
                                if (isset($Matiere_idFiliere) && $fil->getIdFiliere() == $Matiere_idFiliere) {
                                    print("<option selected='selected' value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                } else {
                                    print("<option value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                <input class="myButton" type="submit" value="Rechercher">
            </form>
            <?php
                if (isset($_POST['listeMatiere_dept']) || isset($_POST['listeMatiere_filiere'])) {
                    ?>
            <table class="table-fill">
                <thead>
                    <tr>
                        <td>Matière</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $matieres = [];

                        // Si on n'a choisi qu'un département.
                        if (isset($Matiere_idDepartement)) {

                            // Si on a aussi choisi une filière.
                            if (isset($Matiere_idFiliere)) {

                                // On récupère les matières de la filière.
                                $matieres = $dataManagement->selectAllMatiereByFiliere($Matiere_idFiliere);
                            } else {
                                // On récupère les matières du département.
                                $matieres = $dataManagement->selectAllMatiereByDepartement($Matiere_idDepartement);
                            }
                        } else {
                            // On récupère toutes les matières.
                            $matieres = $dataManagement->selectAllMatiere();
                        }
                        
                        // Afficher les matières.
                        foreach ($matieres as $matiere) {
                            print("<tr><td>".$matiere->getLibelle()."</td></tr>");
                        }
                    ?>
                </tbody>
            </table>
            <?php
                } ?>
        </div>
    </div>
</section>