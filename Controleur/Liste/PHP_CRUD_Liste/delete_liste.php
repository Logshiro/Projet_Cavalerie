<?php
// Par Quentin Mitou

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

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $liste = new Liste($id,"","","");
    //On récupère le produit par son id
    $oneListe = $liste->delete();

    //On affiche un message de succès
    $_SESSION['message'] = "Produit supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_liste.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_liste.php');
}

?>

