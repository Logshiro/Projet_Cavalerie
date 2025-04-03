<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(
        isset($_POST['Libcours']) && !empty($_POST['Libcours']) 
        && isset($_POST['jour']) && !empty($_POST['jour']) 
        && isset($_POST['HD']) && !empty($_POST['HD']) 
        && isset($_POST['HF']) && !empty($_POST['HF'])
        && isset($_POST['idGalop']) && !empty($_POST['idGalop'])
        && isset($_POST['RefCavalier']) && !empty($_POST['RefCavalier'])
    ){

        //On nettoie les données
        $Libcours = strip_tags($_POST['Libcours']);
        $Jour = strip_tags($_POST['jour']);
        $HD = strip_tags($_POST['HD']);
        $HF = strip_tags($_POST['HF']);
        $idGalop = strip_tags($_POST['idGalop']);
        
        //On crée un nouvel objet Cours
        $Cour = new Cours("", $Libcours, $Jour, $HD, $HF, $idGalop);
        //On ajoute d'abord le cours
        $itemP = 2;
        $Cour->add();
        $idCours = $Cour->CoursMax();

        // Ajout séance cours
        $idSeances = $Cour->getCoursAssADD($idCours, $itemP); // Récupère les idCourSeance

        // Vérification des idSeances
        if (empty($idSeances)) {
            $_SESSION['erreur'] = "Aucune séance trouvée pour le cours.";
            header('Location: vue_cours.php');
            die();
        }

        // On ajoute ensuite les cavaliers
        $success = true;
        foreach($_POST['idCL'] as $index => $RefCavalier) {
            $cleanRefCavalier = strip_tags($RefCavalier);
            $Inscrit = new Inscrit($cleanRefCavalier, $idCours);
            if(!$Inscrit->add()) {
                $success = false;
                $_SESSION['erreur'] = "Erreur lors de l'ajout du cavalier: ID invalide";
                break;
            }

        // Check if the idSeance exists in the calendrier table
        if ($Cour->getallSeanceCours($idCours)){
            $Seances = $Cour->getallSeanceCours($idCours);
            // Ajout de la participation pour chaque séance
            foreach ($idSeances as $idSeance) {
                    $participe = new Participe($idSeance, $idCours, $cleanRefCavalier, true); // Assuming 'true' for present
                    if (!$participe->add($idSeance,$idCours,$cleanRefCavalier)) {
                        $success = false;
                        $_SESSION['erreur'] = "Erreur lors de l'ajout de la participation pour le cavalier: ID invalide";
                        break;
                    }
                }
            }
        }

        if($success) {
            $_SESSION['message'] = "Cours ajouté avec succès";
        }

        //On redirige vers la page de la liste
        header('Location: vue_cours.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_cours.php');
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cours</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_cours.js"></script>
    <script src="../Js/jquery.min.js"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Cours</h1>
                <!-- On crée un formulaire pour ajouter un cours -->
                <form method="post" id="coursForm">
                    <div class="form-group">
                        <!-- On crée un label pour le produit -->
                        <label for="Libcours">Libellé :</label>
                        <!-- On crée un champ pour le produit -->
                        <input type="text" name="Libcours" id="Libcours" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le jour -->
                        <label for="jour">Jour :</label>
                        <!-- On crée un champ pour le jour -->
                        <input type="text" name="jour" id="jour" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour l'heure de début -->
                        <label for="HD">Heure de début :</label>
                        <!-- On crée un champ pour l'heure de début -->
                        <input type="time" name="HD" id="HD" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour l'heure de fin -->
                        <label for="HF">Heure de fin :</label>
                        <!-- On crée un champ pour l'heure de fin -->
                        <input type="time" name="HF" id="HF" class="form-control" required>     
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le galop -->
                        <label for="RefGalop">Galop :</label>
                        <!-- On crée un champ pour le galop -->
                        <input type="text" name="RefGalop" id="RefGalop" class="form-control" onkeyup="autocompletGalopI()" required>
                        <div id="nom_list_idGalop" class="list-group"></div>
                        <input type="hidden" name="idGalop" id="idGalop">
                    </div>
                    <div class="form-group" id="cavalierFields">
                        <!-- On crée un label pour le numsir du cavalier -->
                        <label for="RefCavalier">Nom du cavalier :</label>
                        <!-- On crée un champ pour le numsir du cavalier -->
                        <input type="text" id="RefCavalier" name="RefCavalier[]" class="form-control" onkeyup="autocomplet_InsertCL()" required>
                        <div id="nom_list_idCLI" class="list-group"></div>
                        <input type="hidden" name="idCL[]" id="idCL">
                    </div>
                    <!-- Bouton pour ajouter un autre cavalier -->
                    <button type="button" class="btn btn-secondary" onclick="addCavalierField()">Ajouter un autre cavalier</button>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
