<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
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

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $galop = new Galop($id,"");
    //On récupère le produit par son id
    $oneGalop = $galop->delete($id);

    //On affiche un message de succès
    $_SESSION['message'] = "Galop supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_galop.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_galop.php');
}

?>

