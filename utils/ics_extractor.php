<?php
    include 'objets/icsData.php';

    //On initialize la timezone
    // On utilise une commande pour donner la timezone par défault, pour utiliser les DATETIME par la suite
    // On récupère la liste des timeZone UTC et prend la premieère etant donné que l'on est en UTC + 0
    date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);

    /*
    * Recupère un fichier .ics, le parse et en ressors un objet php
    * Cet objet contient toutes les infos permettant de devenir un cours
    */
    function icsExtractor($file)
    {
        $fichier = file_get_contents($file['tmp_name']);

        //Préparation des recherche dans le fichier ics
        $intituleCours = "/SUMMARY:(.*)/";
        $dateCours = "/DTSTART:(.*)/";
        $dateCoursFin = "/DTEND:(.*)/";
        $descCours = "/DESCRIPTION:(.*)/";
        $location = "/LOCATION:(.*)/";

        // n sera le nombre d'élément du fichier ICS
        // recupère dans le tableau $coursTab tout les noms de cours
        $n = preg_match_all($intituleCours, $fichier, $coursTab, PREG_PATTERN_ORDER);
        
        // récupère dans le tableau dateTab tout les élements composant de la date début
        preg_match_all($dateCours, $fichier, $dateTab, PREG_PATTERN_ORDER);
        
        // recupère dans le tableau dateTabEnd tout les éléments composant de la date de fin
        preg_match_all($dateCoursFin, $fichier, $dateTabEnd, PREG_PATTERN_ORDER);
        
        // récupère dans le tableau descTab tout les éléments composant la description des cours (nomProf, promo)
        preg_match_all($descCours, $fichier, $descTab, PREG_PATTERN_ORDER);

        //recupère la salle de cours
        preg_match_all($location, $fichier, $salleTab, PREG_PATTERN_ORDER);

        $returnTab = array();
        // Parcours de tout le tableau
        for ($j=0 ; $j < $n ; ++$j) {
            /*
            * Recupère les données de la fonction en preg_match_all
            */
            
            // Découpe la date de début
            $anneeD = substr($dateTab[0][$j], 8, 4);
            $moisD = substr($dateTab[0][$j], 12, 2);
            $jourD = substr($dateTab[0][$j], 14, 2);
            $heureD = substr($dateTab[0][$j], 17, 2);
            $minD = substr($dateTab[0][$j], 19, 2);

            // Découpe la date de fin
            $anneeF = substr($dateTabEnd[0][$j], 6, 4);
            $moisF = substr($dateTabEnd[0][$j], 10, 2);
            $jourF = substr($dateTabEnd[0][$j], 12, 2);
            $heureF = substr($dateTabEnd[0][$j], 15, 2);
            $minF = substr($dateTabEnd[0][$j], 17, 2);

            //Gestion des données du cours
            $titreCours = substr($coursTab[0][$j], 8);
            $descCours = explode("\\n", substr($descTab[0][$j], 12));
            
            // Retire le premier element du tableau, qui est une chaine vide
            array_splice($descCours, 0, 1);
            // retire le dernier element du tableau qui est la date de l'export
            array_splice($descCours, sizeof($descCours)-1, 1);

            
            //Intialisation des chaines de caractère pour catégoriser les cours
            $promo = "";
            $prof = "";
            // Si il manque des infos alors on rajoutera les informations qui en découle
            for ($i = 0; $i < sizeof($descCours); $i++) {
                
                // Si il n'y a pas de chiffre ni de - et qu'il y a un espace alors c'est bien un prof
                if (stripos($descCours[$i], " ") and preg_match('~[0-9]~', $descCours[$i]) === 0 and preg_match('~-~', $descCours[$i]) === 0) {
                    $prof = $descCours[$i];
                } else {
                    $promo .= $descCours[$i]."\\n";
                }
            }
            
            // Si le prof n'est pas indiqué -->
            if (trim($prof) == "") {
                $prof = "non déterminé";
            }

            // Recupère le nom de la salle et sa description, en le détachant de LOCATION
            $salle = explode(":", $salleTab[0][$j]);
            // Sépare le numéro de salle et sa descritpion
            $salle = explode(" ", $salle[1]);
            //Recupère le num de la salle
            $numSalle = $salle[0];
            //Initialize la variable $descSalle a une chaine prédéfini si non de description
            $descSalle = "";
            if (sizeof($salle) > 1) {
                $descSalle = "(".$salle[1]." ".$salle[2].")";
            }

            // format les données entre elles
            $dateD = $anneeD."-".$moisD."-".$jourD;
            $dateTimeD = new DateTime($dateD);
            $dateTimeD->setTime($heureD, $minD);

            $dateF = $anneeF."-".$moisF."-".$jourF;
            $dateTimeF = new DateTime($dateF);
            $dateTimeF->setTime($heureF, $minF);
            
            // ajoute le nouvel objet de IcsData au tableau de IcsData a return
            $returnTab[$j] = new IcsData($titreCours, $numSalle, $descSalle, $prof, $promo, $dateTimeD, $dateTimeF);
        }

        return $returnTab;
    }
