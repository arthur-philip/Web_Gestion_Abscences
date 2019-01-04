<?php

    // Formulaire de création d'un administratif.
    if (isset($_POST['createAdmin_login']) && isset($_POST['createAdmin_mdp']) && isset($_POST['createAdmin_nom']) && isset($_POST['createAdmin_prenom'])) {

        // Récupération des informations du formulaire.
        $createAdmin_login = htmlspecialchars($_POST['createAdmin_login']);
        $createAdmin_mdp = htmlspecialchars($_POST['createAdmin_mdp']);
        $createAdmin_nom = htmlspecialchars($_POST['createAdmin_nom']);
        $createAdmin_prenom = htmlspecialchars($_POST['createAdmin_prenom']);
        
        // Création d'un nouveau membre du personnel avec ces informations.
        $newPerso = new Personnel(null, $createAdmin_login, $createAdmin_mdp, $createAdmin_nom, $createAdmin_prenom, $resp_administratif);

        // On vérifie que ce login n'est pas déjà utilisé.
        try {
            // On cherche en base de données.
            $exist = $dataManagement->selectPersonnelByLogin($newPerso);
        } catch (Exception $e) {
            // si probleme -> affiche une erreur et sort de la boucle.
            echo "<script>alert('Erreur lors de la vérification de l'existance du personnel administratif.');</script>";
            exit;
        }
        if ($exist == null) {
            // Insérer le personnel en base de donnée.
            try {
                $dataManagement->insertPersonnel($newPerso);
            } catch (Exception $e) {
                // Si probleme -> affiche une erreur et sort de la boucle.
                echo "<script>alert('Erreur lors de la création du personnel administratif.');</script>";
                exit;
            }
            // Afficher un message confirmant l'insertion et vider les valeurs du formulaire.
            echo "<script>alert('Création du personnel administratif réussie.');</script>";
            $createAdmin_login = "";
            $createAdmin_mdp = "";
            $createAdmin_nom = "";
            $createAdmin_prenom = "";
            $_POST = array();
        } else {
            // On affiche une erreur.
            echo "<script>alert('Ce login est déjà utilisé, veuillez en choisir un autre.');</script>";
        }
    }
?>
<section class="row justify-content-center">
    <h2 class="toggleNext">Panel administrateur</h2>
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3">
        <form id="leFormulaire" method="POST" action="index">
            <h4>Création d'un administratif</h4>
            <p>Login</p>
            <p><input type="text" name="createAdmin_login" value="<?php if (isset($createAdmin_login)) {
                echo $createAdmin_login;
            } ?>" required></p>
            <p>Mot de passe</p>
            <p><input type="password" name="createAdmin_mdp" value="<?php if (isset($createAdmin_mdp)) {
                echo $createAdmin_mdp;
            } ?>" required></p>
            <p>Nom</p>
            <p><input type="text" name="createAdmin_nom" value="<?php if (isset($createAdmin_nom)) {
                echo $createAdmin_nom;
            } ?>"></p>
            <p>Prenom</p>
            <p><input type="text" name="createAdmin_prenom" value="<?php if (isset($createAdmin_prenom)) {
                echo $createAdmin_prenom;
            } ?>"></p>
            <input class="myButton" type="submit" value="Créer">
        </form>
    </div>
</section>