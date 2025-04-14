<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $race = new Race($id,"");
    //On récupère la race par son id
    $oneRace = $race->race_id($id);

    //la race n'existe pas
    if(!$oneRace){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucune Race trouvée pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_race.php');
        die();
    }

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $race = new Race($id,"");
    //On récupère la race par son id
    $oneRace = $race->delete($id);

    //On affiche un message de succès
    $_SESSION['message'] = "Race supprimée avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_race.php');
    // die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_race.php');
}

?>

