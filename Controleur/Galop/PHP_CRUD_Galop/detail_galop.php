<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet cavalier
    $galop = new Galop($id,"");
    //On récupère le produit par son id
    $oneGalop = $galop->galop_id($id);

    //le produit n'existe pas
    if(!$oneGalop){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun Galop trouvé pour cet id";  
        //On redirige vers la page de la galop
        header('Location: vue_galop.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la galop
    header('Location: vue_galop.php');
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
                <h1>Détails du produit <?= $oneGalop['LibGalop']; ?></h1>
                <!-- On affiche les informations du produit -->
                <p>Id : <?= $oneGalop['idGalop']; ?></p>
                <p>Libellé : <?= $oneGalop['LibGalop']; ?></p>
            </section>
        </div>
    </main>
</body>
</html>

