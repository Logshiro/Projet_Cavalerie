<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet cours
    $cours = new Cours($id,"","","","","");
    //On récupère le produit par son id
    $oneCours = $cours->cours_id($id);

    //le produit n'existe pas
    if(!$oneCours){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun cours trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_cours.php');
        die();
    }

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $cours1 = new Cours($id,"","","","","");
    $cours2 = new Cours($id,"","","","","");
    $Inscrit = new Inscrit($id,"");
    //On récupère le cours par son id
    //a faire en trigger#############################################################
    
    $cours1->getCoursAssDelete($id);
    $cours2->delete($id);
    $Inscrit->delete_idCours($id);
    
    //On affiche un message de succès
    $_SESSION['message'] = "Cours supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_cours.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_cours.php');
}

?>

