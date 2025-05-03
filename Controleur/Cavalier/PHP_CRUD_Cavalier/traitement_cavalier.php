<?php
session_start();
require_once '../../../Class/class_cavalier.php';

// Vérification si le formulaire est envoyé
if($_POST){
    // Traitement de la suppression
    if ($_POST['action'] === 'Supprimer') {
        if(isset($_POST['idCavalier']) && !empty($_POST['idCavalier'])) {
            $idCavalier = strip_tags($_POST['idCavalier']);
            $cavalier = new Cavalier($idCavalier, "", "", "", "", "", "", "", "", "", "", "", "", "");
            
            if($cavalier->delete($idCavalier)) {
                $_SESSION['message'] = "Cavalier supprimé avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression du cavalier";
            }
        } else {
            $_SESSION['erreur'] = "ID de cavalier manquant pour la suppression";
        }
        header('Location: ../../../Vue/vue_cavalier.php');
        die();
    }

    // Vérification si tous les champs requis sont remplis pour l'ajout et la modification
    if(isset($_POST['Numlicence']) && !empty($_POST['Numlicence']) 
        && isset($_POST['NomCavalier']) && !empty($_POST['NomCavalier'])
        && isset($_POST['PrenomCavalier']) && !empty($_POST['PrenomCavalier'])
        && isset($_POST['DateNaissanceCavalier']) && !empty($_POST['DateNaissanceCavalier'])
        && isset($_POST['NomResponsable']) && !empty($_POST['NomResponsable'])
        && isset($_POST['PreNomResponsable']) && !empty($_POST['PreNomResponsable'])
        && isset($_POST['TelResponsable']) && !empty($_POST['TelResponsable'])
        && isset($_POST['MailResponsable']) && !empty($_POST['MailResponsable'])
        && isset($_POST['Nomcommune']) && !empty($_POST['Nomcommune'])
        && isset($_POST['Assurance']) && !empty($_POST['Assurance'])
        && isset($_POST['idG']) && !empty($_POST['idG'])){

        // Nettoyage des données
        $Numlicence = strip_tags($_POST['Numlicence']);
        $NomCavalier = strip_tags($_POST['NomCavalier']);
        $PrenomCavalier = strip_tags($_POST['PrenomCavalier']);
        $DateNaissanceCavalier = strip_tags($_POST['DateNaissanceCavalier']);
        $NomResponsable = strip_tags($_POST['NomResponsable']);
        $PreNomResponsable = strip_tags($_POST['PreNomResponsable']);
        $TelResponsable = strip_tags($_POST['TelResponsable']);
        $MailResponsable = strip_tags($_POST['MailResponsable']);
        $Nomcommune = strip_tags($_POST['Nomcommune']);
        $Assurance = strip_tags($_POST['Assurance']);
        $RefG = strip_tags($_POST['idG']);

        // Traitement selon l'action
        if ($_POST['action'] === 'Ajouter') {
            $cavalier = new Cavalier(
                "",
                $Numlicence,
                $NomCavalier,
                $PrenomCavalier,
                $DateNaissanceCavalier,
                $NomResponsable,
                $PreNomResponsable,
                $TelResponsable,
                $MailResponsable,
                "", // PasswordResponsable vide pour l'ajout
                "", // COPResponsable vide pour l'ajout
                $Nomcommune,
                $Assurance,
                $RefG
            );
            
            if($cavalier->add()) {
                $_SESSION['message'] = "Cavalier ajouté avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de l'ajout du cavalier";
            }
        } elseif ($_POST['action'] === 'Modifier') {
            if(isset($_POST['idCavalier']) && !empty($_POST['idCavalier'])) {
                $idCavalier = strip_tags($_POST['idCavalier']);
                $cavalier = new Cavalier(
                    $idCavalier,
                    $Numlicence,
                    $NomCavalier,
                    $PrenomCavalier,
                    $DateNaissanceCavalier,
                    $NomResponsable,
                    $PreNomResponsable,
                    $TelResponsable,
                    $MailResponsable,
                    "", // PasswordResponsable vide pour la modification
                    "", // COPResponsable vide pour la modification
                    $Nomcommune,
                    $Assurance,
                    $RefG
                );
                
                if($cavalier->edit()) {
                    $_SESSION['message'] = "Cavalier modifié avec succès";
                } else {
                    $_SESSION['erreur'] = "Erreur lors de la modification du cavalier";
                }
            } else {
                $_SESSION['erreur'] = "ID de cavalier manquant pour la modification";
            }
        }

        // Redirection vers la page de liste
        header('Location: ../../../Vue/vue_cavalier.php');
        die();

    } else {
        // Message d'erreur si le formulaire est incomplet
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: ../../../Vue/vue_cavalier.php');
        die();
    }
} else {
    // Message d'erreur si aucune donnée POST n'est reçue
    $_SESSION['erreur'] = "Aucune donnée reçue";
    header('Location: ../../../Vue/vue_cavalier.php');
    die();
}