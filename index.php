<?php
/*
 * Description de index.php
 * fichier démarrage de l'application
 * @author Quentin
 * Creation 01/2021
 * Dernière MAJ 05/01/2024
 */

include_once "getRacine.php"; // Vérifiez que ce fichier est correctement configuré

include_once "$racine/Controleur/C_Site/controleurPrincipal.php";

// Vérifiez si une action est définie dans l'URL, sinon utilisez "defaut"
$action = isset($_GET['action']) ? $_GET['action'] : "defaut";
// Inclure le fichier correspondant
$fichier = controleurPrincipal($action);
//var_dump($fichier);
// Vérifier que le fichier existe avant de l'inclure
if (file_exists("$racine/Controleur/C_Site/$fichier")) {
    require_once "$racine/Controleur/C_Site/$fichier";
} else {
    echo "Erreur : Le fichier '$fichier' n'existe pas.";
    exit;
}

?>