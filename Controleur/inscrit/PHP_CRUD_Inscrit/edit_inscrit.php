<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['idCavalier_old']) && !empty($_POST['idCavalier_old'])
        && isset($_POST['idCours_old']) && !empty($_POST['idCours_old'])
        && isset($_POST['idCavalier']) && !empty($_POST['idCavalier'])
        && isset($_POST['idCours']) && !empty($_POST['idCours'])){

        //On nettoie les données
        $id1 = strip_tags($_POST['idCavalier_old']);
        $id2 = strip_tags($_POST['idCours_old']);
        $idCavalier = strip_tags($_POST['idCavalier']);
        $idCours = strip_tags($_POST['idCours']);

        //On crée un nouvel objet Cavalerie
        $inscrit = new Inscrit($idCavalier, $idCours);
        
        //afficher le produit
        $oneInscrit = $inscrit->edit($id1, $id2);

        //On affiche un message de succès
        $_SESSION['message'] = "Inscrit modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_inscrit.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_inscrit.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id1']) && !empty($_GET['id1'])
        && isset($_GET['id2']) && !empty($_GET['id2'])){ 

        //on nettoie l'id envoyé
        $id1 = strip_tags($_GET['id1']);
        $id2 = strip_tags($_GET['id2']);

        //on instancie un objet inscrit
        $inscrit = new Inscrit($id1,$id2);
        //On récupère le produit par son id
        $oneInscrit = $inscrit->inscrit_id($id1,$id2);

        //le produit n'existe pas
        if(!$oneInscrit){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_inscrit.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_inscrit.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une inscrit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_inscrit.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier l'inscrit</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="RefCavalier">Cavalier :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="RefCavalier" id="RefCavalier" class="form-control" value="<?php echo $inscrit->getCavalierInscrit($oneInscrit['RefCavalier']); ?>" onkeyup="autocompletCavalierE()" required>
                        <div id="nom_list_idCavalierE" class="list-group"></div>
                        <input type="hidden" name="idCavalier" id="idCavalier" value="<?php echo $oneInscrit['RefCavalier']; ?>">
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="RefCours">Cours :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="text" name="RefCours" id="RefCours" class="form-control" value="<?php echo $inscrit->getCoursInscrit($oneInscrit['RefCours']); ?>" onkeyup="autocompletCoursE()" required>
                        <div id="nom_list_idCoursE" class="list-group"></div>
                        <input type="hidden" name="idCours" id="idCours" value="<?php echo $oneInscrit['RefCours']; ?>">
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <input type="hidden" name="idCavalier_old" id="idCavalier_old" value="<?php echo $oneInscrit['RefCavalier']; ?>">
                    <input type="hidden" name="idCours_old" id="idCours_old" value="<?php echo $oneInscrit['RefCours']; ?>">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
