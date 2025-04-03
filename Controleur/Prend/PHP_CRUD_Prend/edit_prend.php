<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['idCavalier_old']) && !empty($_POST['idCavalier_old'])
        && isset($_POST['idPension_old']) && !empty($_POST['idPension_old'])
        && isset($_POST['idCavalier']) && !empty($_POST['idCavalier'])
        && isset($_POST['idPension']) && !empty($_POST['idPension'])){

        //On nettoie les données
        $id1 = strip_tags($_POST['idCavalier_old']);
        $id2 = strip_tags($_POST['idPension_old']);
        $idCavalier = strip_tags($_POST['idCavalier']);
        $idPension = strip_tags($_POST['idPension']);

        //On crée un nouvel objet Cavalerie
        $prend = new Prend($idCavalier, $idPension);
        
        //afficher le produit
        $onePrend = $prend->edit($id1, $id2);

        //On affiche un message de succès
        $_SESSION['message'] = "Inscrit modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_prend.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_prend.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id1']) && !empty($_GET['id1'])
        && isset($_GET['id2']) && !empty($_GET['id2'])){ 

        //on nettoie l'id envoyé
        $id1 = strip_tags($_GET['id1']);
        $id2 = strip_tags($_GET['id2']);

        //on instancie un objet prend
        $prend = new Prend($id1,$id2);
        //On récupère le produit par son id
        $onePrend = $prend->prend_id($id1,$id2);

        //le produit n'existe pas
        if(!$onePrend){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_prend.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_prend.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un prend</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_prend.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier le prend</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="RefCavalier">Cavalier :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="RefCavalier" id="RefCavalier" class="form-control" value="<?php echo $prend->getCavalierPrend($onePrend['RefIdCava']); ?>" onkeyup="autocompletCavalierE()" required>
                        <div id="nom_list_idCavalierE" class="list-group"></div>
                        <input type="hidden" name="idCavalier" id="idCavalier" value="<?php echo $onePrend['RefIdCava']; ?>">
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="RefPension">Pension :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="text" name="RefPension" id="RefPension" class="form-control" value="<?php echo $prend->getPensionPrend($onePrend['RefIdPen']); ?>" onkeyup="autocompletPensionE()" required>
                        <div id="nom_list_idPensionE" class="list-group"></div>
                        <input type="hidden" name="idPension" id="idPension" value="<?php echo $onePrend['RefIdPen']; ?>">
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <input type="hidden" name="idCavalier_old" id="idCavalier_old" value="<?php echo $onePrend['RefIdCava']; ?>">
                    <input type="hidden" name="idPension_old" id="idPension_old" value="<?php echo $onePrend['RefIdPen']; ?>">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
