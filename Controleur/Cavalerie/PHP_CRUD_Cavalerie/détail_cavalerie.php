<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet cavalerie
    $C_cavalerie = new Cavalerie($id,"","","","","");
    //On récupère la cavalerie par son id
    $onecavalerie = $C_cavalerie->cavalerie_id($id);

    //On récupère les photos de la cavalerie
    $photos = $C_cavalerie->cavalerie_photo($id);

    //le produit n'existe pas
    if(!$onecavalerie){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucune cavalerie trouvé pour cet id";  
        //On redirige vers la page de la cavalerie
        header('Location: vue_cavalerie.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la cavalerie
    header('Location: vue_cavalerie.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails de la cavalerie</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Détails de la cavalerie <?= $onecavalerie['NomCheval']; ?></h1>
                <!-- On affiche les informations de la cavalerie -->
                <p>Id : <?= $onecavalerie['NumSir']; ?></p>
                <p>Nom : <?= $onecavalerie['NomCheval']; ?></p>
                <p>Date de naissance : <?= $onecavalerie['DateNC']; ?></p>
                <p>Garot : <?= $onecavalerie['Garot']; ?></p>
                <p>Race : <?= $C_cavalerie->getCavalerieRace($onecavalerie['RefRace']); ?></p>
                <p>Robe : <?= $C_cavalerie->getCavalerieRobe($onecavalerie['RefRobe']); ?></p>
                <!-- On affiche les photos de la cavalerie -->
                <div class="row">
                    <?php foreach($photos as $photo): ?>
                        <div class="col-md-4 mb-3">             
                            <img src="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                 alt="Photo de <?= htmlspecialchars($onecavalerie['NomCheval']); ?>" 
                                 class="img-fluid rounded"
                                 style="max-height: 300px; object-fit: cover;">
                            <p class="small text-muted mt-2">Photo de <?= htmlspecialchars($onecavalerie['NomCheval']); ?></p>
                            
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

