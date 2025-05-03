<?php
session_start();
require_once '../../../Class/class_galop.php';

// Sécurisation des données envoyées via POST
$LibGalop = strip_tags($_POST['LibGalop']);
$idGalop = isset($_POST['idGalop']) ? strip_tags($_POST['idGalop']) : '';

// Traitement pour l'ajout d'un galop
if ($_POST['action'] === 'Ajouter') {
    $galop = new Galop("", $LibGalop);
    $result = $galop->add();
    if(!empty($result)){
        $_SESSION['message'] = 'Galop ajouté avec succès.';
    }else{
        $_SESSION['erreur'] = "Ce galop existe déjà";
    }
    header("Location: ../../../Vue/vue_galop.php");
}

// Traitement pour la modification d'un galop
if ($_POST['action'] === 'Modifier') {
    $galop = new Galop($idGalop, $LibGalop);
    $result = $galop->edit();
    if(!empty($result)){
        $_SESSION['message'] = 'Galop modifié avec succès.';
    }else{
        $_SESSION['erreur'] = "Ce galop existe déjà";
    }
    header("Location: ../../../Vue/vue_galop.php");
}

// Traitement pour la suppression d'un galop
if ($_POST['action'] === 'Supprimer') {
    $galop = new Galop("", "");
    $result = $galop->delete($idGalop);
    if(!empty($result)){
        $_SESSION['message'] = "Galop supprimé avec succès";
    }else{
        $_SESSION['erreur'] = "Erreur lors de la suppression du galop";
    }
    header("Location: ../../../Vue/vue_galop.php");
} 