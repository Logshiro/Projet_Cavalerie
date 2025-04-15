<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id1']) && !empty($_GET['id1'])
&& isset($_GET['id2']) && !empty($_GET['id2'])){ 

    //on nettoie l'id envoyé
    $id1 = strip_tags($_GET['id1']);
    $id2 = strip_tags($_GET['id2']);

    //on instancie un objet pension
    $C_prend = new Prend($id1,$id2);
    //On récupère les informations de l'inscrit par son id
    $oneprend = $C_prend->prend_id($id1,$id2);

    //le prend n'existe pas
        if(!$oneprend){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun prend trouvé pour cet id";  
        //On redirige vers la page du prend
        header('Location: vue_prend.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de l'inscrit
    header('Location: vue_prend.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails de l'inscrit</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                    <h1>Détails du prend <?= $C_prend->getCavalierPrend($oneprend['RefIdCava']); ?></h1>
                <!-- On affiche les informations du prend -->
                <p>Cavalier : <?= $C_prend->getCavalierPrend($oneprend['RefIdCava']); ?></p>
                <p>Pension : <?= $C_prend->getPensionPrend($oneprend['RefIdPen']); ?></p>
            </section>
        </div>
    </main>
</body>
</html>

