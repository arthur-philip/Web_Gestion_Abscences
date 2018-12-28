<?php
	session_start();
	// Si l'utilisateur n'est pas connecté -> redirection vers la connexion
	if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
		header('Location: pages/connexion');
		exit();
	}
	
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
	<h1>Acceuil</h1>
	<h3>Bonjour <?php echo $_SESSION['login'];?></h3>
	<a href="utils/deconnexion.php">Deconnexion</a>
	<?php
        //icsExtractor(file_get_contents("ICS/Informatique.ics"));
	 	//var_dump(icsExtractor(file_get_contents("ICS/Informatique.ics")));
	?>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>