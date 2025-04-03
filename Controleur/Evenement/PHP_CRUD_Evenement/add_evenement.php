<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['TitreE']) && !empty($_POST['TitreE']) 
        && isset($_POST['CommentaireE']) && !empty($_POST['CommentaireE'])
        && isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto'])
    ){

        //On nettoie les données
        $TitreE = strip_tags($_POST['TitreE']);
        $CommentaireE = strip_tags($_POST['CommentaireE']);
        
        //On crée un nouvel objet Evenement
        $Evenement = new Evenement("", $TitreE, $CommentaireE);
        //On ajoute le produit
        $MEvenement = $Evenement->add();

        //On récupère l'id de l'evenement
        $idEvenement = $Evenement->evenementMax();

        //On traite chaque photo
        foreach($_FILES['LibPhoto']['tmp_name'] as $key => $tmp_name) {
            if($_FILES['LibPhoto']['error'][$key] === 0) {
                // Définir le chemin absolu du dossier de destination
                $uploadDir = __DIR__ . '/Uploads/EvenementPH/';
                
                // Créer le dossier de manière récursive s'il n'existe pas
                if (!file_exists($uploadDir)) {
                    // On essaie de créer le dossier avec tous les droits
                    if (!mkdir($uploadDir, 0777, true)) {
                        $_SESSION['erreur'] = "Impossible de créer le dossier uploads";
                        header('Location: vue_evenement.php');
                        die();
                    }
                    // On s'assure que les permissions sont correctement définies
                    chmod($uploadDir, 0777);
                }

                $fileData = [
                    'name' => $_FILES['LibPhoto']['name'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['LibPhoto']['error'][$key],
                    'size' => $_FILES['LibPhoto']['size'][$key],
                    'type' => $_FILES['LibPhoto']['type'][$key]
                ];
                
                try {
                    $Evenement->evenement_photo_add($fileData, $idEvenement);
                } catch (Exception $e) {
                    $_SESSION['erreur'] = "Erreur lors de l'upload : " . $e->getMessage();
                    header('Location: vue_evenement.php');
                    die();
                }
            }
        }

        //On affiche un message de succès
        $_SESSION['message'] = "Evenement ajouté avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_evenement.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la liste
        header('Location: vue_evenement.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/addPhotos.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Evenement</h1>
                <!-- On crée un formulaire pour ajouter un evenement -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- On crée un label pour le produit -->
                        <label for="TitreE">Titre :</label>
                        <!-- On crée un champ pour le produit -->
                        <input type="text" name="TitreE" id="TitreE" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="CommentaireE">Commentaire :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="CommentaireE" id="CommentaireE" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour les photos -->
                        <label for="LibPhoto">Photos :</label>
                        <!-- On crée un champ pour les photos -->
                        <input type="file" name="LibPhoto[]" id="LibPhoto1" class="form-control photo-input" onchange="handleFileSelect(this)" multiple accept="image/*">
                        <div id="additional-photos"></div>
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
