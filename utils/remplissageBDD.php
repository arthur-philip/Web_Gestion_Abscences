<?php
	ini_set('max_execution_time', 600);
	include_once('import_etudiant.php');
	include_once('ics_extractor.php');
	include_once('objets/icsData.php');
	include_once('objets/Matiere.php');
	include_once('objets/Salle.php');
	include_once('objets/Cour.php');
	include_once('objets/Personnel.php');
	include_once('objets/Anime.php');
	include_once('objets/Filiere.php');
	include_once('objets/Groupe.php');
	include_once('objets/CoursGroupe.php');
	
	if (isset($_FILES['icsFile']) && isset($_FILES['csvFile'])) {
		
		$dataManagement = new DataManagement();
		
		if ($_FILES['icsFile']['name'] != "" && $_FILES['csvFile']['name'] != ""){
			// ------------ importation des données ics
	
			$icsTab = icsExtractor($_FILES['icsFile']);
			
			importIcs($_FILES['icsFile']['name'], $icsTab, $dataManagement);
			// ------------ importation des données csv
			
			importEtudiant($_FILES['csvFile']);
			
		} else if($_FILES['icsFile']['name'] != "" && $_FILES['csvFile']['name'] == "") {
		
			// ------------ importation des données ics
			$icsTab = icsExtractor($_FILES['icsFile']);			
			
			importIcs($_FILES['icsFile']['name'], $icsTab, $dataManagement);
			// ------------ Création des données supplémentaires

			
		} else if($_FILES['icsFile']['name'] == "" &&  $_FILES['csvFile']['name'] != "") {
			
			// ------------ importation des données csv
			importEtudiant($_FILES['csvFile']);
			
		} else {
			
			echo "merci de selectionner au moins un fichier";
		}
	}

	function importIcs($fileName, $icsTab, DataManagement $dataManagement){
		
		foreach($icsTab as $icsData){
				
			$newMatiere = new Matiere(null, $icsData->getTitreCours());
			try {
				$dataManagement->insertMatiere($newMatiere);
			} catch (Exception $e) {
				 echo $e->getMessage();
			}
			
			$newSalle = new Salle(null, $icsData->getNumSalle(), $icsData->getDescSalle());
			try {
				$dataManagement->insertSalle($newSalle);
			} catch (Exception $e) {
				 echo $e->getMessage();
			}			
			
			$id_matiere = $dataManagement->selectIdMatiere($icsData->getTitreCours());
			$idMatiere = $id_matiere[0];
			
			$id_salle = $dataManagement->selectIdSalle($icsData->getNumSalle());
			$idSalle = $id_salle[0];
			
			
			$newCours = new Cours(null, $idMatiere, $idSalle, $icsData->getDateTimeD(), $icsData->getDateTimeF());
			try {
				$dataManagement->insertCours($newCours);
			} catch (Exception $e) {
				 echo $e->getMessage();
			}
			
			if($icsData->getProf() != "non déterminé"){
				
				$mdp = "".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9);
				
				$login = str_replace(" ", ".", $icsData->getProf());
				
				$nomPre = explode(" ", $icsData->getProf());
				
				$newProf = new Personnel(null, $login, $mdp, $nomPre[0], $nomPre[1], 2);
				
				try {
					$dataManagement->insertPersonnel($newProf);
				} catch (Exception $e) {
					 echo $e->getMessage();
				}
				
				
				$id_cours = $dataManagement->selectIdCours($idMatiere, $idSalle, $icsData->getDateTimeD(), $icsData->getDateTimeF());
				$idCours = $id_cours[0];
				
				$id_personnel = $dataManagement->selectIdPersonnel($login);
				$idPersonnel = $id_personnel[0];
				
				
				$newAnime = new Anime($idCours, $idPersonnel);
				
				try {
					$dataManagement->insertAnime($newAnime);
				} catch (Exception $e) {
					 echo $e->getMessage();
				}
				
				$newFiliere = new Filiere(null, null, $fileName);
				try {
					$dataManagement->insertFiliereSansDep($newFiliere->getLibelle());
				} catch (Exception $e) {
					 echo $e->getMessage();
				}
				
				$id_filiere = $dataManagement->selectIdFiliere($fileName);
				$idFilliere = $id_filiere[0];
				$newGroupe = new Groupe(null, $idFilliere, $icsData->getPromo());
				try {
					$dataManagement->insertGroupe($newGroupe);
				} catch (Exception $e) {
					 echo $e->getMessage();
				}
				
				$id_groupe = $dataManagement->selectIdGroupe($icsData->getPromo());
				$idGroupe = $id_groupe[0];
				
				$newCoursGroupe = new CoursGroupe($idCours, $idGroupe);
				try {
					$dataManagement->insertCoursGroupe($newCoursGroupe);
				} catch (Exception $e) {
					 echo $e->getMessage();
				}
			}	
		}	
	}
?>

<form method="POST" action="index" class="leFormulaire" enctype="multipart/form-data">
	<h3>Importations des étudiants et des plannings</h3>

	<p>ICS File</p>
	<p><input type="file" name="icsFile" accept=".ics"></p>

	<p>CSV File</p>
	<p><input type="file" name="csvFile" accept=".csv"></p>

	<input class="myButton" type="submit" value="Importer">
	
</form>