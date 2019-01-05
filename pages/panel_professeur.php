<?php

// Formulaire d'affichage des absences en fonction du département, de la filière et du groupe.
if (isset($_POST['listeAbsence_dept']) && trim($_POST['listeAbsence_dept']) != "") {
    
    // On prend l'id du département choisi.
    $absence_idDepartement = htmlspecialchars($_POST['listeAbsence_dept']);

    // Si une filière a étée choisie préalablement.
    if (isset($_POST['listeAbsence_filiere']) && trim($_POST['listeAbsence_filiere']) != "") {

        // On prend l'id de la filiere choisie.
        $absence_idFiliere = htmlspecialchars($_POST['listeAbsence_filiere']);

        if (isset($_POST['listeAbsence_groupe']) && trim($_POST['listeAbsence_groupe']) != "") {

            // On prend l'id du groupe choisi.
            $absence_idGroupe = htmlspecialchars($_POST['listeAbsence_groupe']);
        }
    }
}

if (isset($_POST['listeAbsence_etudiant']) && trim($_POST['listeAbsence_etudiant']) != "") {
    $listeAbsence_etudiant = htmlspecialchars($_POST['listeAbsence_etudiant']);
}

// Gestion de la création d'une absence
if (isset($_POST['absence_etudiant']) && trim($_POST['absence_etudiant']) != "") {
    $absence_etudiant = explode(" ", htmlspecialchars($_POST['absence_etudiant']));
    // Récup l'étudiant
    $absence_completeEtudiant = $dataManagement->selectEtudiantByNomPrenom($absence_etudiant[0], $absence_etudiant[1]);
}

if (isset($_POST['absence_cours']) && trim($_POST['absence_cours']) != "") {
    // On récupère les valeurs du cours et de l'étudiant.
    $absence_cours = explode("-", htmlspecialchars($_POST['absence_cours']));

    // Création de l'absence.
    try {
        $dataManagement->insertAbsence($absence_cours[1], $absence_cours[0]);
    } catch (Exception $e) {
        // Si probleme -> affiche une erreur et sort de la boucle.
        echo "<script>alert('Erreur lors de la création de l'absence'.');</script>";
        exit;
    }
    // Afficher un message confirmant l'insertion
    echo "<script>alert('Création de l'absence réussie.');</script>";
}

?>
<section>
    <h2 class="toggleNext">Panel professeur</h2>
    <div class="row">
        <div class="col-12 col-lg-3 ">
            <form class="leFormulaire" method="POST" action="index">
                <h3>Saisie d'une absence</h3>
                <p>Étudiant :</p>
                <p><input type="text" name="absence_etudiant" placeholder="Nom Prénom" value="<?php if (isset($absence_etudiant)) {
                    echo $absence_etudiant[0]." ".$absence_etudiant[1];
                }?>"></p>
                <input class="myButton" type="submit" value="Rechercher">
            </form>
            <form class="leFormulaire" method="POST" action="index">
                <p>Cours :</p>
                <p><select name="absence_cours">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on saisi un étudiant.
                        // Si on a saisi un étudiant.
                        if (isset($absence_completeEtudiant)) {
                            // Récupérer les cours de l'étudiant.
                            $cours = $dataManagement->selectAllCoursByEtudiant($absence_completeEtudiant[1], $absence_completeEtudiant[2]);

                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($cours as $cour) {
                                $libelle = $cour[0]." en ".$cour[1]." : ".$cour[2]." - ".$cour[3];
                                if (isset($absence_cours) && $cour["id_cours"] == $absence_cours) {
                                    print("<option selected='selected' value='".$cour[4]."-".$absence_completeEtudiant[0]."'>".$libelle."</option>");
                                } else {
                                    print("<option value='".$cour[4]."-".$absence_completeEtudiant[0]."'>".$libelle."</option>");
                                }
                            }
                        }
                    ?>
                </select></p>
                <input class="myButton" type="submit" value="Créer">
            </form>
        </div>
        <div class="col-12 col-lg-9">
            <form class="leFormulaire" method="POST" action="index">
                <h3>Liste des absences</h3>
                Étudiant :
                <input type="text" name="listeAbsence_etudiant" placeholder="Nom Prénom" value="<?php if (isset($listeAbsence_etudiant)) {
                    echo $listeAbsence_etudiant;
                }?>">
                Département :
                <select name="listeAbsence_dept">
                    <option value=""></option>
                    <?php
                        // On récupére tous les départements.
                        $departements = $dataManagement->selectAllDepartement();
                        
                        // On crée une option pour chacun d'eux (avec son id en value).
                        foreach ($departements as $dept) {
                            if (isset($absence_idDepartement) && $dept->getIdDepartement() == $absence_idDepartement) {
                                print("<option selected='selected' value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            } else {
                                print("<option value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }
                        }
                    ?>
                </select>
                Filière :
                <select name="listeAbsence_filiere">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi un département.
                        if (isset($absence_idDepartement)) {
                            // On récupère la liste des filières de ce département.
                            $filieres = $dataManagement->selectAllFiliereByDepartement($absence_idDepartement);
                            
                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($filieres as $fil) {
                                if (isset($absence_idFiliere) && $fil->getIdFiliere() == $absence_idFiliere) {
                                    print("<option selected='selected' value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                } else {
                                    print("<option value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                Groupe :
                <select name="listeAbsence_groupe">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi une filière.
                        if (isset($absence_idFiliere)) {

                            // On récupère la liste des groupes de cette filiere.
                            $groupes = $dataManagement->selectAllGroupeByFiliere($absence_idFiliere);

                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($groupes as $groupe) {
                                if (isset($absence_idGroupe) && $groupe[0] == $absence_idGroupe) {
                                    print("<option selected='selected' value='".$groupe[0]."'>".$groupe[2]."</option>");
                                } else {
                                    print("<option value='".$groupe[0]."'>".$groupe[2]."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                <input class="myButton" type="submit" value="Rechercher">
            </form>
            <?php
                if (isset($_POST['listeAbsence_etudiant']) || isset($_POST['listeAbsence_dept']) || isset($_POST['listeAbsence_filiere']) || isset($_POST['listeAbsence_groupe'])) {
                    ?>
            <table class="table-fill">
                <thead>
                    <tr>
                        <td>Étudiant</td>
                        <td>Matière</td>
                        <td>Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $abcences = [];
                    // Si on n'a choisi qu'un département.
                    if (isset($absence_idDepartement)) {
                        // Si on a aussi choisi une filière.
                        if (isset($absence_idFiliere)) {
                            // Si on a aussi choisi un groupe.
                            if (isset($absence_idGroupe)) {
                                // On récupère les absences du groupe.
                                $abcences = $dataManagement->selectAllAbsenceByGroupe($absence_idGroupe);
                            } else {
                                // On récupère les absences de la filiere.
                                $abcences = $dataManagement->selectAllAbsenceByFilere($absence_idFiliere);
                            }
                        } else {
                            // On récupère les absences du département.
                            $abcences = $dataManagement->selectAllAbsenceByDepartement($absence_idDepartement);
                        }
                    } else {
                        // On récupère toutes les absences.
                        $abcences = $dataManagement->selectAllAbsence();
                    }
                    // Afficher les absences.
                    foreach ($abcences as $abcence) {
                        // Si on cherche un étudiant en particulier.
                        if (isset($listeAbsence_etudiant)) {
                            // Si le nom recherché se trouve dans l'une des absences, on l'affiche.
                            if ($listeAbsence_etudiant == ($abcence[0]." ".$abcence[1])) {
                                print("<tr><td>".$abcence[0]." ".$abcence[1]."</td><td>".$abcence[2]."</td><td>".$abcence[3]." - ".$abcence[4]."</td></tr>");
                            }
                        }
                        // Si on ne cherche pas d'étudiant en particulier, on affiche toutes les absences.
                        else {
                            print("<tr><td>".$abcence[0]." ".$abcence[1]."</td><td>".$abcence[2]."</td><td>".$abcence[3]." - ".$abcence[4]."</td></tr>");
                        }
                    } ?>
                </tbody>
            </table>
            <?php
                } ?>
        </div>
    </div>
</section>