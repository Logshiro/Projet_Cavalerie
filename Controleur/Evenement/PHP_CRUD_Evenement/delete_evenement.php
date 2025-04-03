<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet evenement
    $evenement = new Evenement($id,"","");
    //On récupère le evenement par son id
    $oneEvenement = $evenement->evenement_id($id);

    //le evenement n'existe pas
    if(!$oneEvenement){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun evenement trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_evenement.php');
        die();
    }

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet evenement
    $evenement = new Evenement($id,"","");
    //On récupère le evenement par son id
    $oneEvenement = $evenement->delete();

    //On affiche un message de succès
    $_SESSION['message'] = "Evenement supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_evenement.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_evenement.php');
}

?>

