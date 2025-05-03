<?php
session_start();
require_once '../../Class/class_Organisation.php';

// Sécurisation des données envoyées via POST
$idInfo = strip_tags($_POST['idInfo']);
$idCompetition = strip_tags($_POST['idCompetition']);

// Traitement pour l'ajout d'une organisation
if ($_POST['action'] === 'Ajouter') {
    $Organisation = new Organisation($idInfo, $idCompetition);
    $result = $Organisation->add();
    if(!empty($result)){
        $_SESSION['message'] = 'Organisation ajouté avec succès.';
    }else{
        $_SESSION['erreur'] = "Organisation déjat existante";
    }
    header("Location: ../../../Vue/Crud/All/vue_Organisation.php");
}

// Traitement pour la modification d'une organisation
if ($_POST['action'] === 'Modifier') {
    $idInfoOld = strip_tags($_POST['idInfo_old']);
    $idCompetitionOld = strip_tags($_POST['idCompetition_old']);
    $Organisation = new Organisation($idInfo, $idCompetition);
    $result = $Organisation->edit($idInfoOld, $idCompetitionOld);
    if(!empty($result)){
        $_SESSION['message'] = 'Organisation modifiée avec succès.';
    }else{
        $_SESSION['erreur'] = "Organisation déjat existante";
    }
    
    header("Location: ../../../Vue/Crud/All/vue_Organisation.php");
}

// Traitement pour la suppression d'une organisation
if ($_POST['action'] === 'Supprimer') {
    $Organisation = new Organisation($idInfo, $idCompetition);
    $result = $Organisation->delete();
    //On affiche un message de succès
    $_SESSION['message'] = "Organisation supprimé avec succès";
    header("Location: ../../../Vue/Crud/All/vue_Organisation.php");
}