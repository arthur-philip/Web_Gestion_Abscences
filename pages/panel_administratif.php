<?php

    //icsExtractor(file_get_contents("ICS/Informatique.ics"));
    //var_dump(icsExtractor(file_get_contents("ICS/Informatique.ics")));

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
?>
<section>
    <?php
    // TODO:
        // Importation des étudiants
        // Importation des plannings (Filière par filière)
        // Suppression d’un planning (Filière par filière)
        // Voir les listes associées (étudiants + matières)
    ?>
    <h2 class="toggleNext">Panel administratif</h2>
    <div>
        <div>
            <h3>Création d'un professeur</h3>
            <form method="POST" action="index">
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
                <input type="text" name="createProf_prenom" value="<?php if (isset($createProf_prenom)) {
        echo $createProf_prenom;
    } ?>">
                <input type="submit" value="Créer">
            </form>
        </div>
        <div>
            <h3>Création d'un département</h3>
            <form method="POST" action="index">
                <p>Nom</p>
                <input type="text" name="createDepart_nom" value="<?php if (isset($createDepart_nom)) {
        echo $createDepart_nom;
    } ?>">
                <input type="submit" value="Créer">
            </form>
        </div>
        <div>
            <h3>Création d'une filière</h3>
            <form method="POST" action="index">
                <p>Nom</p>
                <input type="text" name="createFiliere_nom" value="<?php if (isset($createFiliere_nom)) {
        echo $createFiliere_nom;
    } ?>">
                <p>Département</p>
                <select name="createFiliere_dep">
                <option value=""></option>
                    <?php

                        // On récupére tous les départements.
                        $departements = $dataManagement->selectAllDepartement();
                        
                        // On crée une option pour chacun d'eux (avec son id en value).
                        foreach ($departements as $dept) {
                            if(isset($createFiliere_dep) && $dept->getIdDepartement() == $createFiliere_dep){
                                print("<option selected='selected' value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }else{
                                print("<option value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }
                        }
                    ?>
                </select>
                <input type="submit" value="Créer">
            </form>
        </div>
        <div>
            <h3>Importations des étudiants et des plannings + suppression d'un planning</h3>
        </div>
        <div>
            <h3>Liste des étudiants</h3>
        </div>
        <div>
            <h3>Liste des matières</h3>
        </div>
    </div>
</section>