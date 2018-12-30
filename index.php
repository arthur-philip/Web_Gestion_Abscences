<?php
    session_start();

	// Si l'utilisateur n'est pas connecté (ses informations ne sont pas dans la session) -> redirection vers la connexion
	if(!isset($_SESSION['login']) && !isset($_SESSION['password']) && !isset($_SESSION['nom']) && !isset($_SESSION['prenom']) && !isset($_SESSION['responsabilite'])){
		header('Location: pages/connexion');
		exit();
	}
    
    // VARIABLES DES RESPONSABILITÉS
    $resp_administrateur=0;
    $resp_administratif=1;
    $resp_professeur=2;

    include_once('utils/ics_extractor.php');
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Acceuil</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<h1>Acceuil</h1>
		<h3>Login: <?php print $_SESSION['login'];?></h3>
		<h3>Nom: <?php print $_SESSION['nom'];?></h3>
		<h3>Prenom: <?php print $_SESSION['prenom'];?></h3>
		<h3>Responsabilite: <?php print $_SESSION['responsabilite'];?></h3>
		<a href="utils/deconnexion.php">Deconnexion</a>
	</header>
	<!--TODO: Affichage en fonction du niveau de responsabilité de la personne connectée-->
	<?php
        // Si l'utilisateur connecté est un administrateur
        if($_SESSION['responsabilite'] == $resp_administrateur){
            include_once('pages/panel_administrateur.php');
            include_once('pages/panel_administratif.php');
		    include_once('pages/panel_professeur.php');
        }
        // Si l'utilisateur connecté est un administratif
        else if($_SESSION['responsabilite'] == $resp_administratif){
            include_once('pages/panel_administratif.php');
		    include_once('pages/panel_professeur.php');
        }
        // Si l'utilisateur connecté est un professeur
        else if($_SESSION['responsabilite'] == $resp_professeur){
            include_once('pages/panel_professeur.php');
        }
	?>
	<footer>
		<p>Copyright</p>
	</footer>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>