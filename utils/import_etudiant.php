<?php
    include_once('objets/Etudiant.php');
    include_once('objets/Groupe_etudiant.php');
	
    function importEtudiant($fichier)
	{
		
        $fp = file_get_contents($fichier['tmp_name']);
		
		$dataManagement = new DataManagement();
		
        $liste = explode(" ", $fp);
        foreach ($liste as $etudiant) {
            $champs = explode("|", $etudiant);
			
			if($champs[0] != "INE"){
				// création d'un nouvel étudiant ine, nom, prenom
				$newEtudiant = new Etudiant($champs[0], $champs[1], $champs[2]);
				
				// création d'un nouveau groupe_étudiant ine, groupe
				$newGroupe_etudiant = new Groupe_etudiant($champs[3], $champs[0]);	
				
				try {
					$dataManagement->insertEtudiant($newEtudiant);
					$dataManagement->insertGroupe_etudiant($newGroupe_etudiant);
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
        }
    }
