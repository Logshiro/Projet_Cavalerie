<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['LibRobe']) && !empty($_POST['LibRobe'])){

        //On nettoie les données
        $LibRobe = strip_tags($_POST['LibRobe']);
        //On crée un nouvel objet Robe
        $Robe = new Robe("", $LibRobe);
        //On ajoute le Robe
        $MPro = $Robe->add();

        //On affiche un message de succès
        $_SESSION['message'] = "Robe ajouté avec succès";
        //On redirige vers la page de la robe
        header('Location: vue_robe.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la robe
        header('Location: vue_robe.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Robe</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Robe</h1>
                <!-- On crée un formulaire pour ajouter un robe -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="LibRobe">Nom de la Robe :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="LibRobe" id="LibRobe" class="form-control" required>
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
