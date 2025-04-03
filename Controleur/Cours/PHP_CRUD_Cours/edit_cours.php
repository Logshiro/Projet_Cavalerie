<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['Libcours']) && !empty($_POST['Libcours']) 
        && isset($_POST['jour']) && !empty($_POST['jour']) 
        && isset($_POST['HD']) && !empty($_POST['HD']) 
        && isset($_POST['HF']) && !empty($_POST['HF'])
        && isset($_POST['idGalop']) && !empty($_POST['idGalop'])){

        //On nettoie les données
        $id = strip_tags($_GET['id']);
        $Libcours = strip_tags($_POST['Libcours']);
        $Jour = strip_tags($_POST['jour']);
        $HD = strip_tags($_POST['HD']);
        $HF = strip_tags($_POST['HF']);
        $idGalop = strip_tags($_POST['idGalop']);
        //On crée un nouvel objet Liste
        $cours = new Cours($id, $Libcours, $Jour, $HD, $HF, $idGalop);
        
        //afficher le produit
        $oneCours = $cours->edit();

        //On affiche un message de succès
        $_SESSION['message'] = "Cours modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_cours.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_cours.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet liste
        $cours = new Cours($id,"","","","","");
        //On récupère le produit par son id
        $oneCours = $cours->cours_id($id);

        $NomCavalier = $cours->getCours_CavalierP( $id);

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
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Cours</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_cours.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier le Cours</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le produit -->
                        <label for="Libcours">Libellé :</label>
                        <!-- On crée un champ pour le produit -->
                        <input type="text" name="Libcours" id="Libcours" class="form-control" value="<?php echo $oneCours['Libcours']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le jour -->
                        <label for="jour">Jour :</label>
                        <!-- On crée un champ pour le jour -->
                        <input type="text" name="jour" id="jour" class="form-control" value="<?php echo $oneCours['jour']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="HD">Heure de début :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="time" name="HD" id="HD" class="form-control" value="<?php echo $oneCours['HD']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="HF">Heure de fin :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="time" name="HF" id="HF" class="form-control" value="<?php echo $oneCours['HF']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le galop -->
                        <label for="RefGalop">Galop :</label>
                        <!-- On crée un champ pour le galop -->
                        <input type="text" name="RefGalop" id="RefGalop" class="form-control" onkeyup="autocompletGalop()"  value = "<?php echo $cours->getCours_Galop($oneCours['RefGalop']); ?>" required>
                        <div id="nom_list_idGalop" class="list-group"></div>
                        <input type="hidden" name="idGalop" id="idGalop" value="<?php echo $oneCours['RefGalop']; ?>">
                    </div>
                  
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <input type="hidden" name="id" id="id" value="<?php echo $oneCours['idCours']; ?>">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
