<?php
session_start();
require_once '../../../Class/class_robe.php';

// Sécurisation des données envoyées via POST
$LibRobe = strip_tags($_POST['LibRobe']);
$idRobe = isset($_POST['idRobe']) ? strip_tags($_POST['idRobe']) : '';

// Traitement pour l'ajout d'une robe
if ($_POST['action'] === 'Ajouter') {
    $robe = new Robe("", $LibRobe);
    $result = $robe->add();
    if(!empty($result)){
        $_SESSION['message'] = 'Robe ajoutée avec succès.';
    }else{
        $_SESSION['erreur'] = "Cette robe existe déjà";
    }
    header("Location: ../../../Vue/vue_robe.php");
}

// Traitement pour la modification d'une robe
if ($_POST['action'] === 'Modifier') {
    $robe = new Robe($idRobe, $LibRobe);
    $result = $robe->edit();
    if(!empty($result)){
        $_SESSION['message'] = 'Robe modifiée avec succès.';
    }else{
        $_SESSION['erreur'] = "Cette robe existe déjà";
    }
    header("Location: ../../../Vue/vue_robe.php");
}

// Traitement pour la suppression d'une robe
if ($_POST['action'] === 'Supprimer') {
    $robe = new Robe("", "");
    $result = $robe->delete($idRobe);
    if(!empty($result)){
        $_SESSION['message'] = "Robe supprimée avec succès";
    }else{
        $_SESSION['erreur'] = "Erreur lors de la suppression de la robe";
    }
    header("Location: ../../../Vue/vue_robe.php");
}