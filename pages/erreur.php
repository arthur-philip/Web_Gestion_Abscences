<html>
<head>
	<meta charset="utf-8" />
	<title>Erreur</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="../css/errorPage.css">
</head>
<body>
    <div class="error">
        <h1>
        <?php
            // Affiche l'erreur passé dans l'url.
            echo htmlspecialchars($_GET["erreur"]);
        ?>
        </h1>
    </div>
</body>
</html>