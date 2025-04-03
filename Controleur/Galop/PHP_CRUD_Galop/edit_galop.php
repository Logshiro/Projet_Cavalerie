<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST['LibGalop']) && !empty($_POST['LibGalop'])){

        //On nettoie les données
        $id = strip_tags($_POST['id']);
        $LibGalop = strip_tags($_POST['LibGalop']);
            
        //On crée un nouvel objet Galop
        $galop = new Galop($id, $LibGalop);
        
        //afficher le produit
        $oneGalop = $galop->edit();

        //On affiche un message de succès
        $_SESSION['message'] = "Galop modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_galop.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_galop.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet galop
        $galop = new Galop($id,"");
        //On récupère le produit par son id
        $oneGalop = $galop->galop_id($id);

        //le produit n'existe pas
        if(!$oneGalop){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucun Galop trouvé pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_galop.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_galop.php');
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
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier le Galop</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="LibGalop">Libellé du Galop :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="LibGalop" id="LibGalop" class="form-control" value="<?php echo $oneGalop['LibGalop']; ?>" required>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
