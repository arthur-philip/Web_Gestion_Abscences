<?php

// Formulaire d'affichage des abscences en fonction du département, de la filière et du groupe.
if (isset($_POST['listeAbscence_dept']) && trim($_POST['listeAbscence_dept']) != "") {
    
    // On prend l'id du département choisi.
    $idDepartement = htmlspecialchars($_POST['listeAbscence_dept']);

    // Si une filière a étée choisie préalablement.
    if (isset($_POST['listeAbscence_filiere']) && trim($_POST['listeAbscence_filiere']) != "") {

        // On prend l'id de la filiere choisie.
        $idFiliere = htmlspecialchars($_POST['listeAbscence_filiere']);

        if (isset($_POST['listeAbscence_groupe']) && trim($_POST['listeAbscence_groupe']) != "") {

            // On prend l'id du groupe choisi.
            $idGroupe = htmlspecialchars($_POST['listeAbscence_groupe']);
        }
    }
}

if (isset($_POST['listeAbscence_etudiant']) && trim($_POST['listeAbscence_etudiant']) != "") {
    $listeAbscence_etudiant = htmlspecialchars($_POST['listeAbscence_etudiant']);
}

if (isset($_POST['abscence_etudiant']) && trim($_POST['abscence_etudiant']) != "") {
    $abscence_etudiant = htmlspecialchars($_POST['abscence_etudiant']);
    $etudiant = explode(" ", $abscence_etudiant);
    // Récup l'étudiant
    $completeEtudiant = $dataManagement->selectEtudiantByNomPrenom($etudiant[0], $etudiant[1]);
}

if (isset($_POST['abscence_cours']) && trim($_POST['abscence_cours']) != "") {
    // On récupère les valeurs du cours et de l'étudiant.
    $abscence_cours = explode("-", htmlspecialchars($_POST['abscence_cours']));

    // Créer l'absence
    try {
        $dataManagement->insertAbscence($abscence_cours[1], $abscence_cours[0]);
    } catch (Exception $e) {
        // Si probleme -> affiche une erreur et sort de la boucle.
        echo "<script>alert('Erreur lors de la création de l'abscence'.');</script>";
        exit;
    }
    // Afficher un message confirmant l'insertion
    echo "<script>alert('Création de l'abscence réussie.');</script>";
}

?>
<section>
    <h2 class="toggleNext">Panel professeur</h2>
    <div>
        <div>
            <h3>Saisie d'une abscence</h3>
            <form method="POST" action="index">
                Étudiant :
                <input type="text" name="abscence_etudiant" placeholder="Nom Prénom" value="<?php if (isset($abscence_etudiant)) {
    echo $abscence_etudiant;
}?>">
                <input type="submit" value="Rechercher">
            </form>
            <form method="POST" action="index">
                Cours :
                <select name="abscence_cours">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on saisi un étudiant.
                        // Si on a saisi un étudiant.
                        if (isset($completeEtudiant)) {
                            // Récupérer les cours de l'étudiant.
                            $cours = $dataManagement->selectAllCoursByEtudiant($completeEtudiant[1], $completeEtudiant[2]);

                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($cours as $cour) {
                                $libelle = $cour[0]." en ".$cour[1]." : ".$cour[2]." - ".$cour[3];
                                if (isset($abscence_cours) && $cour["id_cours"] == $abscence_cours) {
                                    print("<option selected='selected' value='".$cour[4]."-".$completeEtudiant[0]."'>".$libelle."</option>");
                                } else {
                                    print("<option value='".$cour[4]."-".$completeEtudiant[0]."'>".$libelle."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                <input type="submit" value="Créer">
            </form>
            
        </div>
        <div>
            <h3>Liste des abscences</h3>
            <form method="POST" action="index">
                Étudiant :
                <input type="text" name="listeAbscence_etudiant" placeholder="Nom Prénom" value="<?php if (isset($listeAbscence_etudiant)) {
                        echo $listeAbscence_etudiant;
                    }?>">
                Département :
                <select name="listeAbscence_dept">
                    <option value=""></option>
                    <?php
                        // On récupére tous les départements.
                        $departements = $dataManagement->selectAllDepartement();
                        
                        // On crée une option pour chacun d'eux (avec son id en value).
                        foreach ($departements as $dept) {
                            if (isset($idDepartement) && $dept->getIdDepartement() == $idDepartement) {
                                print("<option selected='selected' value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            } else {
                                print("<option value='".$dept->getIdDepartement()."'>".$dept->getLibelle()."</option>");
                            }
                        }
                    ?>
                </select>
                Filière :
                <select name="listeAbscence_filiere">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi un département.
                        if (isset($idDepartement)) {
                            // On récupère la liste des filières de ce département.
                            $filieres = $dataManagement->selectAllFiliereByDepartement($idDepartement);
                            
                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($filieres as $fil) {
                                if (isset($idFiliere) && $fil->getIdFiliere() == $idFiliere) {
                                    print("<option selected='selected' value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                } else {
                                    print("<option value='".$fil->getIdFiliere()."'>".$fil->getLibelle()."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                Groupe :
                <select name="listeAbscence_groupe">
                    <option value=""></option>
                    <?php
                        // TODO: maj avec AJAX quand on choisi une filière.
                        if (isset($idFiliere)) {

                            // On récupère la liste des groupes de cette filiere.
                            $groupes = $dataManagement->selectAllGroupeByFiliere($idFiliere);

                            // On crée une option pour chacun d'eux (avec son id en value).
                            foreach ($groupes as $groupe) {
                                if (isset($idGroupe) && $groupe[0] == $idGroupe) {
                                    print("<option selected='selected' value='".$groupe[0]."'>".$groupe[2]."</option>");
                                } else {
                                    print("<option value='".$groupe[0]."'>".$groupe[2]."</option>");
                                }
                            }
                        }
                    ?>
                </select>
                <input type="submit" value="Rechercher">
            </form>
            <?php
                if (isset($_POST['listeAbscence_dept']) || isset($_POST['listeAbscence_filiere']) || isset($_POST['listeAbscence_groupe'])) {
                    ?>
            <table>
                <tr>
                    <td>Étudiant</td>
                    <td>Matière</td>
                    <td>Date</td>
                </tr>
                <?php
                    $abcences = [];
                    // Si on n'a choisi qu'un département.
                    if (isset($idDepartement)) {
                        // Si on a aussi choisi une filière.
                        if (isset($idFiliere)) {
                            // Si on a aussi choisi un groupe.
                            if (isset($idGroupe)) {
                                // On récupère les abscences du groupe.
                                $abcences = $dataManagement->selectAllAbscenceByGroupe($idGroupe);
                            } else {
                                // On récupère les abscences de la filiere.
                                $abcences = $dataManagement->selectAllAbscenceByFilere($idFiliere);
                            }
                        } else {
                            // On récupère les abscences du département.
                            $abcences = $dataManagement->selectAllAbscenceByDepartement($idDepartement);
                        }
                    } else {
                        // On récupère toutes les abscences.
                        $abcences = $dataManagement->selectAllAbscence();
                    }
                    // Afficher les abscences.
                    foreach ($abcences as $abcence) {
                        // Si on cherche un étudiant en particulier.
                        if (isset($listeAbscence_etudiant)) {
                            // Si le nom recherché se trouve dans l'une des abscences, on l'affiche.
                            if ($listeAbscence_etudiant == ($abcence[0]." ".$abcence[1])) {
                                print("<tr><td>".$abcence[0]." ".$abcence[1]."</td><td>".$abcence[2]."</td><td>".$abcence[3]." - ".$abcence[4]."</td></tr>");
                            }
                        }
                        // Si on ne cherche pas d'étudiant en particulier, on affiche toutes les abscences.
                        else {
                            print("<tr><td>".$abcence[0]." ".$abcence[1]."</td><td>".$abcence[2]."</td><td>".$abcence[3]." - ".$abcence[4]."</td></tr>");
                        }
                    } ?>
            </table>
            <?php
                } ?>
        </div>
    </div>
</section>