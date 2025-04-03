<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['LibRace']) && !empty($_POST['LibRace'])){

        //On nettoie les données
        $LibRace = strip_tags($_POST['LibRace']);
        //On crée un nouvel objet Race
        $race = new Race("", $LibRace);
        //On ajoute la Race
        $MPro = $race->add();

        //On affiche un message de succès
        $_SESSION['message'] = "Race ajoutée avec succès";
        //On redirige vers la page de la race
        header('Location: vue_race.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la race
        header('Location: vue_race.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Race</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter une Race</h1>
                <!-- On crée un formulaire pour ajouter une race -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="LibRace">Libellé de la Race :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="LibRace" id="LibRace" class="form-control" required>
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
