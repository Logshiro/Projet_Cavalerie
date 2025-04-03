<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet evenement
    $evenement = new Evenement($id,"","");
    //On récupère le produit par son id
    $oneEvenement = $evenement->evenement_id($id);

    //On récupère les photos de l'evenement
    $photos = $evenement->evenement_photo($id);

    //le produit n'existe pas
    if(!$oneEvenement){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun evenement trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_evenement.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_evenement.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails du evenement</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Détails de l'evenement <?= $oneEvenement['TitreE']; ?></h1>
                <!-- On affiche les informations du evenement -->
                <p>Id : <?= $oneEvenement['idEvenement']; ?></p>
                <p>Titre : <?= $oneEvenement['TitreE']; ?></p>
                <p>Commentaire : <?= $oneEvenement['CommentaireE']; ?></p>
                <!-- On affiche les photos de l'evenement -->
                <div class="row">
                    <?php foreach($photos as $photo): ?>
                        <div class="col-md-4 mb-3">             
                            <img src="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                 alt="Photo de <?= htmlspecialchars($oneEvenement['TitreE']); ?>" 
                                 class="img-fluid rounded"
                                 style="max-height: 300px; object-fit: cover;">
                            <p class="small text-muted mt-2">Photo de <?= htmlspecialchars($oneEvenement['TitreE']); ?></p>
                            
                            <a href="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                               target="_blank" 
                               class="btn btn-sm btn-primary">
                                Voir en grand
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>
</body>
</html>

