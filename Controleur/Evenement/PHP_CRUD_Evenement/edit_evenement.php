<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){

    //On vérifie si l'id de la photo est défini et non vide dans le formulaire
    if(isset($_POST['action']) && $_POST['action'] == 'delete_photo'
        && isset($_POST['photo_id']) && !empty($_POST['photo_id'])
        && isset($_POST['id']) && !empty($_POST['id'])
    ){
        $photo_id = strip_tags($_POST['photo_id']);
        $id = strip_tags($_POST['id']);

        $E_evenement = new Evenement($id,"","");

        $E_evenement->deleteimg($photo_id, $id);

        $_SESSION['message'] = "Photo supprimée avec succès";
        //On redirige vers la page de la liste
        // &action=Modifier
        header('Location: vue_evenement.php?id=' . $id . '&action=Modifier');
        die();


    }   

    //On vérifie si les champs sont remplis
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['TitreE']) && !empty($_POST['TitreE']) 
        && isset($_POST['CommentaireE']) && !empty($_POST['CommentaireE'])){

        //On nettoie les données
        $id = strip_tags($_POST['id']);
        $TitreE = strip_tags($_POST['TitreE']);
        $CommentaireE = strip_tags($_POST['CommentaireE']);
        
        //On crée un nouvel objet Evenement
        $evenement = new Evenement($id, $TitreE, $CommentaireE);
        
        //afficher le evenement
        $oneEvenement = $evenement->edit();

        // Traitement des photos après la mise à jour réussie
        if(isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto']['name'][0])) {
            foreach($_FILES['LibPhoto']['name'] as $key => $name) {
                if($_FILES['LibPhoto']['error'][$key] === 0) {
                    $fileData = [
                        'name' => $name,
                        'tmp_name' => $_FILES['LibPhoto']['tmp_name'][$key],
                        'error' => $_FILES['LibPhoto']['error'][$key],
                        'size' => $_FILES['LibPhoto']['size'][$key],
                        'type' => $_FILES['LibPhoto']['type'][$key]
                    ];
                    
                    try {
                        $evenement->evenement_photo_add($fileData, $id);
                    } catch (Exception $e) {
                        $_SESSION['erreur'] = "Erreur lors de l'upload : " . $e->getMessage();
                    }
                }
            }
        }

        //On affiche un message de succès
        $_SESSION['message'] = "Produit modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_evenement.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_evenement.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet evenement
        $evenement = new Evenement($id,"","");
        //On récupère le evenement par son id
        $oneEvenement = $evenement->evenement_id($id);

        //On récupère les photos de l'evenement
        $photos = $evenement->evenement_photo($id);

        //le evenement n'existe pas
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
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Evenement</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_evenement.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
    <script src="../Js/addPhotos.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier les Evenement</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- On crée un label pour le produit -->
                        <label for="TitreE">Titre :</label>
                        <!-- On crée un champ pour le produit -->
                        <input type="text" name="TitreE" id="TitreE" class="form-control" value="<?php echo $oneEvenement['TitreE']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="CommentaireE">Commentaire :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="CommentaireE" id="CommentaireE" class="form-control" value="<?php echo $oneEvenement['CommentaireE']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour les photos -->
                        <label for="LibPhotoAdd">Photos :</label>
                        <!-- On crée un champ pour les photos -->
                        <input type="file" name="LibPhoto[]" id="LibPhoto" class="form-control photo-input" onchange="handleFileSelect(this)" multiple accept="image/*">
                        <div id="additional-photos"></div>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?php echo $oneEvenement['idEvenement']; ?>">
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button type="submit" class="btn btn-primary mt-3" style="z-index: 1; position: relative;">
                            Envoyer
                        </button>
                    </div>
                </form>
                <div class="row">
                    <?php if(isset($photos) && is_array($photos)): ?>
                        <?php foreach($photos as $photo): ?>
                            <div class="col-md-4 mb-3">             
                                <img src="<?= htmlspecialchars($photo['LibPhoto'] ?? ''); ?>" 
                                     alt="Photo de <?= htmlspecialchars($oneEvenement['TitreE'] ?? ''); ?>" 
                                     class="img-fluid rounded"
                                     style="max-height: 300px; object-fit: cover;">
                                <p class="small text-muted mt-2">Photo de <?= htmlspecialchars($oneEvenement['TitreE'] ?? ''); ?></p>
                                    
                                <a href="<?= htmlspecialchars($photo['LibPhoto'] ?? ''); ?>" 
                                   target="_blank" 
                                   class="btn btn-sm btn-primary">
                                    Voir en grand
                                </a>
                                <form method="post" style="display:inline;" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="delete_photo">
                                    <input type="hidden" name="photo_id" value="<?= htmlspecialchars($photo['idPhoto'] ?? ''); ?>">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($oneEvenement['idEvenement']); ?>">
                                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>
</body>
