<?php
    include_once('objets/Etudiant.php');
    include_once('objets/Groupe_etudiant.php');
    
    function importEtudiant($fichier)
    {
        $fp = file_get_contents($fichier['tmp_name']);
        
        $dataManagement = new DataManagement();
        
        $requete = $dataManagement->getDB()->prepare("INSERT INTO etudiant (ine_etudiant,nom,prenom) VALUES (:ine_etudiant,:nom,:prenom)");
        
        $liste = explode(" ", $fp);
        foreach ($liste as $etudiant) {
            $champs = explode("|", $etudiant);
            
            if ($champs[0] != "INE") {
                // création d'un nouvel étudiant ine, prenom, nom
                $newEtudiant = new Etudiant($champs[0], $champs[1], $champs[2]);
                
                // création d'un nouveau groupe_étudiant ine, groupe
                $newGroupe_etudiant = new Groupe_etudiant($champs[0], $champs[3]);
                try {
                    $dataManagement->insertEtudiant($newEtudiant, $requete);
                    $dataManagement->insertGroupe_etudiant($newGroupe_etudiant);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
