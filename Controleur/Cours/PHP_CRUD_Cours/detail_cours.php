<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet cours
    $cours = new Cours($id,"","","","","");        
    //On récupère le produit par son id
    $oneCours = $cours->cours_id($id);

    $NomCavalier = $cours->getCours_CavalierP($id);

    //le produit n'existe pas
    if(!$oneCours){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun cours trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_cours.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_cours.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails du cours</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Détails du cours <?= $oneCours['Libcours']; ?></h1>
                <!-- On affiche les informations du produit -->
                <p>Id : <?= $oneCours['idCours']; ?></p>
                <p>Cours : <?= $oneCours['Libcours']; ?></p>
                <p>Jour : <?= $oneCours['jour']; ?></p>
                <p>Horaire de début : <?= $oneCours['HD']; ?></p>
                <p>Horaire de fin : <?= $oneCours['HF']; ?></p>
                <p>Galop : <?= $cours->getCours_Galop($oneCours['RefGalop']); ?></p>
                        <?php foreach ($NomCavalier as $index => $cavalier): ?>
                            <div class="input-group mb-3">
                                <p>Inscrit : <?php echo $cours->getCours_Cavalier($cavalier['RefCavalier']); ?></p>
                        <?php endforeach; ?>
                    </div>
            </section>
        </div>
    </main>
</body>
</html>

