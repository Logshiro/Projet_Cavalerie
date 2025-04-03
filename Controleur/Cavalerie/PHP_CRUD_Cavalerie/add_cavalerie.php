<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['NomCheval']) && !empty($_POST['NomCheval']) 
        && isset($_POST['DateNC']) && !empty($_POST['DateNC'])
        && isset($_POST['Garot']) && !empty($_POST['Garot'])
        && isset($_POST['idRace']) && !empty($_POST['idRace'])
        && isset($_POST['idRobe']) && !empty($_POST['idRobe'])
        && isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto'])
        ){

        //On nettoie les données
        $NomCheval = strip_tags($_POST['NomCheval']);
        $DateNC = strip_tags($_POST['DateNC']);
        $Garot = strip_tags($_POST['Garot']);
        $idRace = strip_tags($_POST['idRace']);
        $idRobe = strip_tags($_POST['idRobe']);
        
        //On crée un nouvel objet Cavalerie
        $Cavalerie = new Cavalerie("", $NomCheval, $DateNC, $Garot, $idRace, $idRobe);
        //On ajoute la cavalerie
        $MPro = $Cavalerie->add();
        //On récupère l'id de la cavalerie
        $idCavalerie = $Cavalerie->cavalerieMax();
        
        //On traite chaque photo
        foreach($_FILES['LibPhoto']['tmp_name'] as $key => $tmp_name) {
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
                    'name' => $_FILES['LibPhoto']['name'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['LibPhoto']['error'][$key],
                    'size' => $_FILES['LibPhoto']['size'][$key],
                    'type' => $_FILES['LibPhoto']['type'][$key]
                ];
                
                try {
                    $Cavalerie->cavalerie_photo_add($fileData, $idCavalerie);
                } catch (Exception $e) {
                    $_SESSION['erreur'] = "Erreur lors de l'upload : " . $e->getMessage();
                    header('Location: vue_cavalerie.php');
                    die();
                }
            }
        }

        //On affiche un message de succès
        $_SESSION['message'] = "Cavalier ajouté avec succès";
        //On redirige vers la page de la cavalerie
        header('Location: vue_cavalerie.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la cavalerie
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
    <title>Ajouter une Cavalerie</title>

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
                <!-- On affiche un titre -->
                <h1>Ajouter une Cavalerie</h1>
                <!-- On crée un formulaire pour ajouter une cavalerie -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- On crée un label pour le cavalerie -->
                        <label for="NomCheval">Nom Cavalerie :</label>
                        <!-- On crée un champ pour le cavalerie -->
                        <input type="text" name="NomCheval" id="NomCheval" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la date de naissance -->
                        <label for="DateNC">Date de naissance :</label>
                        <!-- On crée un champ pour la date de naissance -->
                        <input type="date" name="DateNC" id="DateNC" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le garot -->
                        <label for="Garot">Garot :</label>
                        <!-- On crée un champ pour le garot -->
                        <input type="text" name="Garot" id="Garot" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour les photos -->
                        <label for="LibPhoto">Photos :</label>
                        <!-- On crée un champ pour les photos -->
                        <input type="file" name="LibPhoto[]" id="LibPhoto" class="form-control photo-input" onchange="handleFileSelect(this)" multiple accept="image/*">
                        <div id="additional-photos"></div>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la référence de la race -->
                        <label for="RefRace">Référence de la race :</label>
                        <!-- On crée un champ pour la référence de la race -->
                        <input type="text" name="RefRace" id="RefRace" class="form-control" onkeyup="autocompletRaceI()" required>
                        <div id="nom_list_idRaceI" class="list-group"></div>
                        <input type="hidden" name="idRace" id="idRace" value="">
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la référence de la robe -->
                        <label for="RefRobe">Référence de la robe :</label>
                        <!-- On crée un champ pour la référence de la robe -->
                        <input type="text" name="RefRobe" id="RefRobe" class="form-control" onkeyup="autocompletRobeI()" required>
                        <div id="nom_list_idRobeI" class="list-group"></div>
                        <input type="hidden" name="idRobe" id="idRobe" value="">
                    </div>
                    
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
