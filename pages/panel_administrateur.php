<?php

    // Si le formulaire a été rempli.
    if (isset($_POST['createAdmin_login']) && isset($_POST['createAdmin_mdp']) && isset($_POST['createAdmin_nom']) && isset($_POST['createAdmin_prenom']) && isset($_POST['createAdmin_resp'])) {

        // Connexion à la base de données.
        try {
            $dataManagement = new DataManagement();
        } catch (Exception $e) {
            // Redirection sur la page d'erreur en cas de problème.
            header('Location: erreur?erreur=Connexion à la base de donnée impossible');
            exit();
        }
        // Récuparation des informations du formulaire.
        $createAdmin_login = htmlspecialchars($_POST['createAdmin_login']);
        $createAdmin_mdp = htmlspecialchars($_POST['createAdmin_mdp']);
        $createAdmin_nom = htmlspecialchars($_POST['createAdmin_nom']);
        $createAdmin_prenom = htmlspecialchars($_POST['createAdmin_prenom']);
        $createAdmin_resp = htmlspecialchars($_POST['createAdmin_resp']);
        
        // Création d'un nouveau membre du personnel avec ces informations.
        $newPerso = new Personnel(null, $createAdmin_login, $createAdmin_mdp, $createAdmin_nom, $createAdmin_prenom, $createAdmin_resp);
        // TODO: Vérifier que ce login n'est pas déjà utilisé

        // insérer le personnel en bdd
        try{
            $dataManagement->insertPersonnel($newPerso);
        } catch(Exception $e){
            // si probleme -> affiche une erreur et sort de la boucle.
            echo "<script>alert('Erreur lors de la création du personnel administratif.);</script>";
            exit;
        }
        // Afficher un message confirmant l'insertion et vide les valeurs du formulaire
        echo "<script>alert('Création du personnel administratif réussie.);</script>";
        $createAdmin_login = "";
        $createAdmin_mdp = "";
        $createAdmin_nom = "";
        $createAdmin_prenom = "";
        $createAdmin_resp = "";
    }

?>
<section>
    <div>
    <h2>Panel administrateur</h2>
        <h3>Création d'un administratif</h3>
        <form method="POST" action="index.php">
            <p>Login</p>
            <input type="text" name="createAdmin_login" value="<?php if (isset($createAdmin_login)) { echo $createAdmin_login; } ?>" required>
            <p>Mot de passe</p>
            <input type="password" name="createAdmin_mdp" required>
            <p>Nom</p>
            <input type="text" name="createAdmin_nom">
            <p>Prenom</p>
            <input type="text" name="createAdmin_prenom">
            <br><br>
            <input type="hidden" name="createAdmin_resp" value="<?php echo $resp_administratif;?>">
            <input type="submit" value="Créer">
        </form>
    </div>
</section>