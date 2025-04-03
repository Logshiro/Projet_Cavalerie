<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['produit']) && !empty($_POST['produit']) 
        && isset($_POST['prix']) && !empty($_POST['prix']) 
        && isset($_POST['nombre']) && !empty($_POST['nombre'])){

        //On nettoie les données
        $id = strip_tags($_GET['id']);
        $Produit = strip_tags($_POST['produit']);
        $Prix = strip_tags($_POST['prix']);
        $Nombre = strip_tags($_POST['nombre']);
        
        //On crée un nouvel objet Liste
        $liste = new Liste($id, $Produit, $Prix, $Nombre);
        
        //afficher le produit
        $oneListe = $liste->edit();

        //On affiche un message de succès
        $_SESSION['message'] = "Produit modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_liste.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_liste.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet liste
        $liste = new Liste($id,"","","");
        //On récupère le produit par son id
        $oneListe = $liste->liste_one($id);

        //le produit n'existe pas
        if(!$oneListe){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_liste.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_liste.php');
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
                <h1>Modifier le Produit</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le produit -->
                        <label for="produit">Produit :</label>
                        <!-- On crée un champ pour le produit -->
                        <input type="text" name="produit" id="produit" class="form-control" value="<?php echo $oneListe['produit']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="prix">Prix :</label>
                        <!-- On crée un champ pour le prix -->
                            <input type="text" name="prix" id="prix" class="form-control" value="<?php echo $oneListe['prix']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="nombre">Nombre :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="number" name="nombre" id="nombre" class="form-control" value="<?php echo $oneListe['nombre']; ?>" required>
                    </div>
                        <input type="hidden" name="id" id="id" value="<?php echo $oneListe['id']; ?>">
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
