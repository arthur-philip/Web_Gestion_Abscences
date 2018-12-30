<?php
	session_start();
	include_once('../utils/DataManagement.php');
	$dataManagement = new DataManagement();// TODO: vérifier que la connexion à la bdd se passe sans soucis, sinon affichage d'une erreur
	// On vérifie s'il y a des informations de connexion dans le POST
	if(isset($_POST['login']) && isset($_POST['password'])){
		// Récupération des informations
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);
		
		// Si la fonction qui vérifie l'existance de l'utilisateur saisi ne renvoi pas -1
		$data = $dataManagement->checkUser($login,$password);
		if($data != -1){
			// Maj des variables de session
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			$_SESSION["nom"]=$data[0];
			$_SESSION["prenom"]=$data[1];
			$_SESSION["responsabilite"]=$data[2];
			// TODO: mettre la responsibilité dans la session
		}
		// Sinon affiche l'erreur
		else{
			echo "<script>alert(\"Login/mot de passe incorrect, réessayez\")</script>";
		}
		/*
		$_SESSION["login"] = $login;
		$_SESSION["password"] = $password;
		*/
	}

	//si user dans la session -> retour à l'index
	if(isset($_SESSION['login']) && isset($_SESSION['password'])){
		header('Location: ../index');
		exit();
	}
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<h1>Connexion</h1>
	<form method="POST" action="connexion">
		<h3>Login</h3>
		<p><input type="text" name="login" placeholder="Entrez votre login ici" value="<?php if(isset($login)) echo $login; ?>" required></p>
		<h3>Mot de passe</h3>
		<p><input type="password" name="password" placeholder="Entrez votre mot de passe ici" value="<?php if(isset($password)) echo $password; ?>" required></p>
		<input type="submit" vlaue="Connexion">
	</form>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>