<?php
    session_start();

    // Si l'utilisateur n'est pas connecté (ses informations ne sont pas dans la session) -> redirection vers la connexion
    if (!isset($_SESSION['login']) && !isset($_SESSION['password']) && !isset($_SESSION['nom']) && !isset($_SESSION['prenom']) && !isset($_SESSION['responsabilite'])) {
        header('Location: pages/connexion');
        exit();
    }

    // Importation des fonctions usuelles de connexion à la base de données.
    include_once('utils/DataManagement.php');
    include_once('objets/Personnel.php');

    // Connexion à la base de données.
    try {
        $dataManagement = new DataManagement();
    } catch (Exception $e) {
        // Redirection sur la page d'erreur en cas de problème.
        header('Location: erreur?erreur=Connexion à la base de donnée impossible');
        exit();
    }

    // VARIABLES DES RESPONSABILITÉS
    $resp_administrateur=0;
    $resp_administratif=1;
    $resp_professeur=2;
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
    <!--HEADER-->
	<header>
		<h1>Acceuil</h1>
		<a href="utils/deconnexion.php">Deconnexion</a>
	</header>
	<!--CONTENU-->
	<?php
        // Si l'utilisateur connecté est un administrateur
        if ($_SESSION['responsabilite'] == $resp_administrateur) {
            include_once('pages/panel_administrateur.php');
            include_once('pages/panel_administratif.php');
            include_once('pages/panel_professeur.php');
        }
        // Si l'utilisateur connecté est un administratif
        elseif ($_SESSION['responsabilite'] == $resp_administratif) {
            include_once('pages/panel_administratif.php');
        }
        // Si l'utilisateur connecté est un professeur
        elseif ($_SESSION['responsabilite'] == $resp_professeur) {
            include_once('pages/panel_professeur.php');
        }
    ?>
    <!--FOOTER-->
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