<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(
        isset($_POST['idCavalier']) && !empty($_POST['idCavalier']) 
        && isset($_POST['idPension']) && !empty($_POST['idPension'])
        ){

        //On nettoie les données
        $idCavalier = strip_tags($_POST['idCavalier']);
        $idPension = strip_tags($_POST['idPension']);
        //On crée un nouvel objet Prend
        $Prend = new Prend( $idCavalier, $idPension);
        //On ajoute le prend
        $MPro = $Prend->add();

        //On affiche un message de succès
        $_SESSION['message'] = "Inscrit ajouté avec succès";
        //On redirige vers la page du prend
        header('Location: vue_prend.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page du prend
        header('Location: vue_prend.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Prend</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_prend.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Prend</h1>
                <!-- On crée un formulaire pour ajouter un prend -->
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
                        <!-- On crée un label pour les pensions -->
                        <label for="RefPension">Nom de la pension :</label>
                        <!-- On crée un champ pour les pensions -->
                        <input type="text" name="RefPension" id="RefPension" class="form-control" onkeyup="autocompletPensionI()" required>
                        <div id="nom_list_idPensionI" class="list-group"></div>
                        <input type="hidden" name="idPension" id="idPension">
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
