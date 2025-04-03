<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet race
    $race = new Race($id,"");
    //On récupère la race par son id
    $oneRace = $race->race_id($id);

    //la race n'existe pas
    if(!$oneRace){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucune Race trouvée pour cet id";  
        //On redirige vers la page de la race
        header('Location: vue_race.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la race
    header('Location: vue_race.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails de la race</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Détails de la race <?= $oneRace['LibRace']; ?></h1>
                <!-- On affiche les informations de la race -->
                <p>Id : <?= $oneRace['idRace']; ?></p>
                <p>Libellé : <?= $oneRace['LibRace']; ?></p>
            </section>
        </div>
    </main>
</body>
</html>

