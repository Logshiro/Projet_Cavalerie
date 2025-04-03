<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(
        isset($_POST['idCavalier']) && !empty($_POST['idCavalier']) 
        && isset($_POST['idCours']) && !empty($_POST['idCours'])
        ){

        //On nettoie les données
        $idCavalier = strip_tags($_POST['idCavalier']);
        $idCours = strip_tags($_POST['idCours']);
        //On crée un nouvel objet Inscrit
        $Inscrit = new Inscrit( $idCavalier, $idCours);
        //On ajoute l'inscrit
        $MPro = $Inscrit->add();

        //On affiche un message de succès
        $_SESSION['message'] = "Inscrit ajouté avec succès";
        //On redirige vers la page du inscrit
        header('Location: vue_inscrit.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page du inscrit
        header('Location: vue_inscrit.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Inscrit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_inscrit.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Inscrit</h1>
                <!-- On crée un formulaire pour ajouter un inscrit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour les cavaliers-->
                        <label for="RefCavalier">Nom du cavalier :</label>
                        <!-- On crée un champ pour les cavaliers -->
                        <input type="text" name="RefCavalier" id="RefCavalier" class="form-control" onkeyup="autocompletCavalierI()" required>
                        <div id="nom_list_idCavalierI" class="list-group"></div>
                        <input type="hidden" name="idCavalier" id="idCavalier">
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour les cours -->
                        <label for="RefCours">Nom du cours :</label>
                        <!-- On crée un champ pour les cours -->
                        <input type="text" name="RefCours" id="RefCours" class="form-control" onkeyup="autocompletCoursI()" required>
                        <div id="nom_list_idCoursI" class="list-group"></div>
                        <input type="hidden" name="idCours" id="idCours">
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
