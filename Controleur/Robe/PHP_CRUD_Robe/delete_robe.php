<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $robe = new Robe($id,"");
    //On récupère le produit par son id
    $oneRobe = $robe->robe_id($id);

    //le produit n'existe pas
    if(!$oneRobe){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun Robe trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_robe.php');
        die();
    }

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $robe = new Robe($id,"");
    //On récupère le produit par son id
    $oneRobe = $robe->delete($id);

    //On affiche un message de succès
    $_SESSION['message'] = "Robe supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_robe.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_robe.php');
}

?>

