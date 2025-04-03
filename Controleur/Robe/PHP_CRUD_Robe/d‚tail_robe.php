<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet cavalier
    $robe = new Robe($id,"");
    //On récupère le produit par son id
    $oneRobe = $robe->robe_id($id);

    //le produit n'existe pas
    if(!$oneRobe){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun Robe trouvé pour cet id";  
        //On redirige vers la page de la robe
        header('Location: vue_robe.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la robe
    header('Location: vue_robe.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails du produit</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Détails de la Robe <?= $oneRobe['LibRobe']; ?></h1>
                <!-- On affiche les informations du produit -->
                <p>Id : <?= $oneRobe['idRobe']; ?></p>
                <p>Nom : <?= $oneRobe['LibRobe']; ?></p>
            </section>
        </div>
    </main>
</body>
</html>

