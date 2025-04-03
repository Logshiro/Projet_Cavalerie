<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $cavalier = new Cavalier($id,"","","","","","","","","","","","","");
    //On récupère le produit par son id
    $oneCavalier = $cavalier->cavalier_id($id);

    //le produit n'existe pas
    if(!$oneCavalier){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_cavalier.php');
        die();
    }

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $cavalier = new Cavalier($id,"","","","","","","","","","","","","");
    //On récupère le produit par son id
    $oneCavalier = $cavalier->delete($id);

    //On affiche un message de succès
    $_SESSION['message'] = "Produit supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_cavalier.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_cavalier.php');
}

?>

