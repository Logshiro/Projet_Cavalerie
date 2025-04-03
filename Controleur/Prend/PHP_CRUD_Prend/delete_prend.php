<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id1']) && !empty($_GET['id1'])
    && isset($_GET['id2']) && !empty($_GET['id2'])
){ 

    //on nettoie l'id envoyé
    $id1 = strip_tags($_GET['id1']);
    $id2 = strip_tags($_GET['id2']);

    //on instancie un objet liste
    $prend = new Prend($id1,$id2);
    //On récupère le produit par son id
    $onePrend = $prend->prend_id($id1, $id2);

    //le produit n'existe pas
    if(!$onePrend){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
        //On redirige vers la page de la liste
        header('Location: vue_prend.php');
        die();
    }

    //on nettoie l'id envoyé
    $id1 = strip_tags($_GET['id1']);
    $id2 = strip_tags($_GET['id2']);

    //on instancie un objet liste
    $prend = new Prend($id1,$id2);
    //On récupère le produit par son id
    $onePrend = $prend->delete();

    //On affiche un message de succès
    $_SESSION['message'] = "Inscrit supprimé avec succès";
    //On redirige vers la page de la liste
    header('Location: vue_prend.php');
    die();

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la liste
    header('Location: vue_prend.php');
}

?>

