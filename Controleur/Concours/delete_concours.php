<?php
// Par Quentin Mitou


// On vérifie si l'id est défini et non vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {

    // On nettoie l'ID envoyé
    $id = strip_tags($_GET['id']);

    // On instancie un objet Concours pour vérifier l'existence du concours
    $concours = new Concours($id, "", "");

    // On récupère les informations du concours par son ID
    $oneConcours = $concours->getConcoursById($id);

    // Si le concours n'existe pas
    if (!$oneConcours) {
        // On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun concours trouvé pour cet ID";
        // On redirige vers la page de la liste des concours
        header('Location: vue_concours.php');
        die();
    }



    // Suppression du concours dans la base de données
    $concours->deleteConcours($id);

    // On affiche un message de succès
    $_SESSION['message'] = "Concours supprimé avec succès";
    // On redirige vers la page des concours
    header('Location: vue_concours.php');
    die();

} else {
    // Si l'URL est invalide ou l'ID n'est pas fourni
    $_SESSION['erreur'] = "URL invalide";
    // On redirige vers la page de la liste des concours
    header('Location: vue_concours.php');
    die();
}
?>
