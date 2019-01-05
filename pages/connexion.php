<?php
    session_start();
    include_once('../utils/DataManagement.php');

    // Connexion à la base de données.
    try {
        $dataManagement = new DataManagement();
    } catch (Exception $e) {
        // Redirection sur la page d'erreur en cas de problème.
        header('Location: erreur?erreur=Connexion à la base de donnée impossible');
        exit();
    }

    // On vérifie s'il y a des informations de connexion dans le POST.
    if (isset($_POST['login']) && isset($_POST['password'])) {
        // Récupération des informations.
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        
        // Si la fonction qui vérifie l'existance de l'utilisateur saisi ne renvoi pas -1.
        $data = $dataManagement->checkUser($login, $password);
        if ($data != -1) {
            // Maj des variables de session
            $_SESSION["login"] = $login;
            $_SESSION["password"] = $password;
            $_SESSION["nom"]=$data[0];
            $_SESSION["prenom"]=$data[1];
            $_SESSION["responsabilite"]=$data[2];
        }
        // Sinon affiche l'erreur.
        else {
            echo "<script>alert(\"Login/mot de passe incorrect, réessayez\")</script>";
        }
    }

    // Si on a un utilisateur dans la session, retour à l'index.
    if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
        header('Location: ../index');
        exit();
    }
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
			<div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3">
				<div id="conteneur">
					<form name="form" class="leFormulaire" method="POST" action="connexion">
                        <h1>Connexion</h1>
						<h3>Login</h3>
                        <p><input type="text" name="login" placeholder="Entrez votre login ici" value="<?php if (isset($login)) {
                            echo $login;
                        } ?>" required></p>
                        <h3>Mot de passe</h3>
                        <p><input type="password" name="password" placeholder="Entrez votre mot de passe ici" value="<?php if (isset($password)) {
                            echo $password;
                        } ?>" required></p>
						<input class="myButton" type="submit" value="Connexion">
					</form>
				</div>
			</div>
        </div>
    </div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>