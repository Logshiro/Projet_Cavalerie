<?php
session_start();
require_once '../../../Class/class_race.php';

// Sécurisation des données envoyées via POST
$LibRace = strip_tags($_POST['LibRace']);
$idRace = isset($_POST['idRace']) ? strip_tags($_POST['idRace']) : '';

// Traitement pour l'ajout d'une race
if ($_POST['action'] === 'Ajouter') {
    $race = new Race("", $LibRace);
    $result = $race->add();
    if(!empty($result)){
        $_SESSION['message'] = 'Race ajoutée avec succès.';
    }else{
        $_SESSION['erreur'] = "Cette race existe déjà";
    }
    header("Location: ../../../Vue/vue_race.php");
}

// Traitement pour la modification d'une race
if ($_POST['action'] === 'Modifier') {
    $race = new Race($idRace, $LibRace);
    $result = $race->edit();
    if(!empty($result)){
        $_SESSION['message'] = 'Race modifiée avec succès.';
    }else{
        $_SESSION['erreur'] = "Cette race existe déjà";
    }
    header("Location: ../../../Vue/vue_race.php");
}

// Traitement pour la suppression d'une race
if ($_POST['action'] === 'Supprimer') {
    $race = new Race("", "");
    $result = $race->delete($idRace);
    if(!empty($result)){
        $_SESSION['message'] = "Race supprimée avec succès";
    }else{
        $_SESSION['erreur'] = "Erreur lors de la suppression de la race";
    }
    header("Location: ../../../Vue/vue_race.php");
}