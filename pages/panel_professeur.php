<div>
    <?php
    //TODO:
        //Enregistrer les absences pour les cours
        //Voir les listes associées (abscence d'un étudiant + abcences)
    ?>
    <h2 class="toggleNext">Panel professeur</h2>
    <div>
        <div>
            <h3>Saisie d'une abscence</h3>
            <!-- TODO: Formulaire étudiant-cours avec proposition de complétion en AJAX-->
        </div>
        <div>
            <h3>Liste des abscences d'un étudiant</h3>
        </div>
        <div>
            <h3>Liste des abscences</h3>
            <form>
                <p>Département</p>
                <select>
                    <?php
                        // TODO: option pour chaque département
                    ?>
                </select>
                <p>Filière</p>
                <select>
                    <?php
                        // TODO: option pour chaque filière en fonction du département
                    ?>
                </select>
                <p>Groupe</p>
                <select>
                    <?php
                        // TODO: option pour chaque groupe en fonction de la filière
                    ?>
                </select>
                <ul>
                    <?php
                        // TODO: Liste des abscences (étudiant/matière/date)
                    ?>
                </ul>
            </form>
        </div>
    </div>
</div>