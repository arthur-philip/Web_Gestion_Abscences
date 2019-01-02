# Gestion des abscences Kuzmycz Pedrero Philip

Site de gestion des abscences pour l'IUT de Rodez.

## Installation

Télécharger WampServer, l'installer et le lancer.
Copier le dossier contenant le projet dans le répertoire 'C:\wamp64\www\'.
Aller sur l'application phpMyAdmin avec son navigateur (http://localhost/phpmyadmin/index.php).
Se connecter avec l'utilisateur 'root' sans mot de passe.
Créer une nouvelle base de donnée 'gestion_eleve' avec l'interclassement 'utf8_general_ci', puis cliquer sur 'Importer'. Choisir le fichier 'gestion_eleve.sql' dans le dossier 'C:\wamp64\www\{dossier du projet}\doc' puis cliquer sur 'Exécuter'.
Une fois l'importation terminée, revenir à http://localhost/phpmyadmin/index.php, puis cliquer sur 'Comptes utilisateurs'.
Cliquer sur 'Ajouter un compte d'utilisateur', puis remplir les champs comme suit :
    - Nom d'utilisateur : 'site_user',
    - Nom d'hôte : 'localhost',
    - Mot de passe : 'KzdGtAhJAzLPswLE',
    - Saisir à nouveau : 'KzdGtAhJAzLPswLE'.
Enfin, dans la section 'Privilèges globaux', cliquer sur la case 'Données', et cliquer sur 'Exécuter' (en bas de la page).

## Usage

Utiliser un navigateur pour vous rendre à l'adresse suivante : 'http://localhost/{dossier du projet}/'.