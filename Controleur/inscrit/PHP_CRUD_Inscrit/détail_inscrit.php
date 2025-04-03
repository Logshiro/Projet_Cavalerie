<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id1']) && !empty($_GET['id1'])
&& isset($_GET['id2']) && !empty($_GET['id2'])){ 

    //on nettoie l'id envoyé
    $id1 = strip_tags($_GET['id1']);
    $id2 = strip_tags($_GET['id2']);

    //on instancie un objet inscrit
    $C_inscrit = new Inscrit($id1,$id2);
    //On récupère les informations de l'inscrit par son id
    $oneinscrit = $C_inscrit->inscrit_id($id1,$id2);

    //le inscrit n'existe pas
        if(!$oneinscrit){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun inscrit trouvé pour cet id";  
        //On redirige vers la page du inscrit
        header('Location: vue_inscrit.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] =   "url invalide";  
    //On redirige vers la page de l'inscrit
    header('Location: vue_inscrit.php');
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
                <h1>Détails de l'inscrit <?= $C_inscrit->getCavalierInscrit($oneinscrit['RefCavalier']); ?></h1>
                <!-- On affiche les informations de l'inscrit -->
                <p>Cavalier : <?= $C_inscrit->getCavalierInscrit($oneinscrit['RefCavalier']); ?></p>
                <p>Cours : <?= $C_inscrit->getCoursInscrit($oneinscrit['RefCours']); ?></p>
            </section>
        </div>
    </main>
</body>
</html>

