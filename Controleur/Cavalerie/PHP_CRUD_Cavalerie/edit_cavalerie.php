<?php
// Par Quentin Mitou

// Vérifiez si le formulaire est envoyé
if ($_POST) {

    //On vérifie si l'id de la photo est défini et non vide dans le formulaire
    if(isset($_POST['action']) && $_POST['action'] == 'delete_photo'
        && isset($_POST['photo_id']) && !empty($_POST['photo_id'])
        && isset($_POST['id']) && !empty($_POST['id'])
    ){
        $photo_lib = strip_tags($_POST['photo_id']);
        $NumSir = strip_tags($_POST['id']);

        $C_cavalerie = new Cavalerie($NumSir,"","","","","");

        $C_cavalerie->deleteimg($photo_lib, $NumSir);

        $_SESSION['message'] = "Photo supprimée avec succès";
        // On redirige vers la page de modification au lieu de la liste
        header('Location: vue_cavalerie.php?id=' . $NumSir . '&action=Modifier');
        die();


    }   

    //On vérifie si les champs sont remplis
    if(isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST['NomCheval']) && !empty($_POST['NomCheval'])
        && isset($_POST['DateNC']) && !empty($_POST['DateNC'])
        && isset($_POST['Garot']) && !empty($_POST['Garot'])
        && isset($_POST['idRace']) && !empty($_POST['idRace'])
        && isset($_POST['idRobe']) && !empty($_POST['idRobe'])
       ){

        //On nettoie les données
        $NumSir = strip_tags($_POST['id']);
        $NomCheval = strip_tags($_POST['NomCheval']);
        $DateNC = strip_tags($_POST['DateNC']);
        $Garot = strip_tags($_POST['Garot']);
        $idRace = strip_tags($_POST['idRace']);
        $idRobe = strip_tags($_POST['idRobe']);
        
        //On crée un nouvel objet Cavalerie
        $cavalerie = new Cavalerie($NumSir, $NomCheval, $DateNC, $Garot, $idRace, $idRobe);
        
        //afficher la cavalerie
        $oneCavalerie = $cavalerie->update();

        // Traitement des photos après la mise à jour réussie
        if(isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto']['name'][0])) {
            foreach($_FILES['LibPhoto']['tmp_name'] as $key => $tmp_name) {
                if($_FILES['LibPhoto']['error'][$key] === 0) {
                    $fileData = [
                        'name' => $_FILES['LibPhoto']['name'][$key],
                        'tmp_name' => $tmp_name,
                        'error' => $_FILES['LibPhoto']['error'][$key],
                        'size' => $_FILES['LibPhoto']['size'][$key],
                        'type' => $_FILES['LibPhoto']['type'][$key]
                    ];
                    
                    try {
                        $cavalerie->cavalerie_photo_add($fileData, $NumSir);
                    } catch (Exception $e) {
                        $_SESSION['erreur'] = "Erreur lors de l'upload : " . $e->getMessage();
                    }
                }
            }
        }

        //On affiche un message de succès
        $_SESSION['message'] = "Cavalerie modifiée avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_cavalerie.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_cavalerie.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $NumSir = strip_tags($_GET['id']);

        //on instancie un objet cavalerie
        $C_cavalerie = new Cavalerie($NumSir,"","","","","");
        //On récupère la cavalerie par son id
        $oneCavalerie = $C_cavalerie->cavalerie_id($NumSir);

        //On récupère les photos de la cavalerie
        $photos = $C_cavalerie->cavalerie_photo($NumSir);
        // var_dump($photos);

        //On récupère les photos de la cavalerie
        // $photos_delete = $C_cavalerie->cavalerie_photo_id($NumSir);

        // $C_cavalerie->deleteimg($photo['id'],$NumSir);

        // Vérifier si des fichiers ont été uploadés
        if(isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto']['name'][0])) {
            //On traite chaque photo
            foreach($_FILES['LibPhoto']['name'] as $key => $name) {
                if($_FILES['LibPhoto']['error'][$key] === 0) {
                    // Définir le chemin absolu du dossier de destination
                    $uploadDir = __DIR__ . '/Uploads/CavaleriePH/';
                    
                    // Créer le dossier de manière récursive s'il n'existe pas
                    if (!file_exists($uploadDir)) {
                        // On essaie de créer le dossier avec tous les droits
                        if (!mkdir($uploadDir, 0777, true)) {
                            $_SESSION['erreur'] = "Impossible de créer le dossier uploads";
                            header('Location: vue_cavalerie.php');
                            die();
                        }
                        // On s'assure que les permissions sont correctement définies
                        chmod($uploadDir, 0777);
                    }

                    $fileData = [
                        'name' => $name,
                        'tmp_name' => $_FILES['LibPhoto']['tmp_name'][$key],
                        'error' => $_FILES['LibPhoto']['error'][$key],
                        'size' => $_FILES['LibPhoto']['size'][$key],
                        'type' => $_FILES['LibPhoto']['type'][$key]
                    ];
                    
                    try {
                        $C_cavalerie->cavalerie_photo_add($fileData, $NumSir);
                    } catch (Exception $e) {
                        $_SESSION['erreur'] = "Erreur lors de l'upload : " . $e->getMessage();
                        header('Location: vue_cavalerie.php');
                        die();
                    }
                }
            }
        }

        //le produit n'existe pas
        if(!$oneCavalerie){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucune cavalerie trouvée pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_cavalerie.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_cavalerie.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la cavalerie</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_cavalerie.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
    <script src="../Js/addPhotos.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <?php
                //On vérifie si un message de succès est présent
                if(isset($_SESSION['message'])){
                    echo "<div class='alert alert-success'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
                ?>
                <!-- On affiche un titre -->
                <h1>Modifier la cavalerie</h1>
                <!-- On crée un formulaire pour ajouter une cavalerie -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="NomCheval">NomCheval :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="NomCheval" id="NomCheval" class="form-control" value="<?php echo $oneCavalerie['NomCheval']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="DateNC">DateNC :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="text" name="DateNC" id="DateNC" class="form-control" value="<?php echo $oneCavalerie['DateNC']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Garot">Garot :</label>
                        <input type="text" name="Garot" id="Garot" class="form-control" value="<?php echo $oneCavalerie['Garot']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la photo -->
                        <label for="LibPhoto">Photo :</label>
                        <!-- On crée un champ pour la photo -->
                        <input type="file" name="LibPhoto[]" id="LibPhoto" class="form-control photo-input" onchange="handleFileSelect(this)" multiple accept="image/*">
                        <div id="additional-photos"></div>
                    </div>
                    <div class="form-group">
                        <label for="RefRace">RefRace :</label>
                        <input type="text" name="RefRace" id="RefRace" class="form-control" value="<?php echo $C_cavalerie->getCavalerieRace($oneCavalerie['RefRace']); ?>" onkeyup="autocompletRace()" required>
                        <div id="nom_list_idRace" class="list-group"></div>
                        <input type="hidden" name="idRace" id="idRace" value="<?php echo $oneCavalerie['RefRace']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="RefRobe">RefRobe :</label>
                        <input type="text" name="RefRobe" id="RefRobe" class="form-control" value="<?php echo $C_cavalerie->getCavalerieRobe($oneCavalerie['RefRobe']); ?>" onkeyup="autocompletRobe()" required>
                        <div id="nom_list_idRobe" class="list-group"></div>
                        <input type="hidden" name="idRobe" id="idRobe" value="<?php echo $oneCavalerie['RefRobe']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $NumSir; ?>">
                        <!-- Ajout de margin et de style pour rendre le bouton plus visible -->
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
                                     alt="Photo de <?= htmlspecialchars($oneCavalerie['NomCheval'] ?? ''); ?>" 
                                     class="img-fluid rounded"
                                     style="max-height: 300px; object-fit: cover;">
                                <p class="small text-muted mt-2">Photo de <?= htmlspecialchars($oneCavalerie['NomCheval'] ?? ''); ?></p>
                                
                                <a href="<?= htmlspecialchars($photo['LibPhoto'] ?? ''); ?>" 
                                   target="_blank" 
                                   class="btn btn-sm btn-primary">
                                    Voir en grand
                                </a>
                                <form method="post" style="display:inline;" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="delete_photo">
                                    <input type="hidden" name="photo_id" value="<?= htmlspecialchars($photo['idPhoto'] ?? ''); ?>">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($NumSir); ?>">
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
</html>
