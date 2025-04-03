<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $pension = new Pension($id,"","","","","");
    //On récupère le produit par son id
    $onePension = $pension->pension_id($id);

    //le produit n'existe pas
    if(!$onePension){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_pension.php');
        die();
    }

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet liste
    $pension = new Pension($id,"","","","","");
    $prend = new Prend("",$id);
    //On récupère le produit par son id
    $onePension = $pension->delete($id);
    $onePrend = $prend->delete_idPen($id);
    //On affiche un message de succès
    $_SESSION['message'] = "Pension supprimée avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_pension.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_pension.php');
}

?>

