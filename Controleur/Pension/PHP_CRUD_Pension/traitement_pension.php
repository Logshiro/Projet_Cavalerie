<?php
session_start();
require_once '../../../Class/class_pension.php';
require_once '../../../Class/class_Prend.php';

// Vérification si le formulaire est envoyé
if($_POST){
    // Traitement de la suppression
    if ($_POST['action'] === 'Supprimer') {
        if(isset($_POST['idPension']) && !empty($_POST['idPension'])) {
            $idPension = strip_tags($_POST['idPension']);
            $pension = new Pension($idPension, "", "", "", "", "", "");
            
            if($pension->delete($idPension)) {
                $_SESSION['message'] = "Pension supprimée avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression de la pension";
            }
        } else {
            $_SESSION['erreur'] = "ID de pension manquant pour la suppression";
        }
        header('Location: ../../../Vue/vue_pension.php');
        die();
    }

    // Vérification si tous les champs requis sont remplis pour l'ajout et la modification
    if(isset($_POST['Tarifs']) && !empty($_POST['Tarifs']) 
        && isset($_POST['LibPension']) && !empty($_POST['LibPension'])
        && isset($_POST['DateDebutP']) && !empty($_POST['DateDebutP'])
        && isset($_POST['DateFinP']) && !empty($_POST['DateFinP'])
        && isset($_POST['idSir']) && !empty($_POST['idSir'])
        && isset($_POST['idCL']) && !empty($_POST['idCL'])){

        // Nettoyage des données
        $Tarifs = strip_tags($_POST['Tarifs']);
        $LibPension = strip_tags($_POST['LibPension']);
        $DateDebutP = strip_tags($_POST['DateDebutP']);
        $DateFinP = strip_tags($_POST['DateFinP']);
        $RefNumSir = strip_tags($_POST['idSir']);
        $idCLs = $_POST['idCL']; // Tableau des IDs des cavaliers

        // Traitement selon l'action
        if ($_POST['action'] === 'Ajouter') {
            $success = true;
            foreach($idCLs as $RefCavalier) {
                $RefCavalier = strip_tags($RefCavalier);
                // Création d'un nouvel objet Pension pour chaque cavalier
                $pension = new Pension("", $Tarifs, $LibPension, $DateDebutP, $DateFinP, $RefNumSir, $RefCavalier);
                
                // Ajout de la pension
                if(!$pension->add()) {
                    $success = false;
                    break;
                }
                
                // Récupération de l'ID de la pension nouvellement créée
                $newPensionId = $pension->getLastInsertId();
                
                if(!$newPensionId) {
                    $success = false;
                    break;
                }
                
                // Création de l'association dans la table prend
                $Prend = new Prend($RefCavalier, $newPensionId);
                if(!$Prend->add()) {
                    $success = false;
                    break;
                }
            }

            if($success) {
                $_SESSION['message'] = "Pension(s) ajoutée(s) avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de l'ajout des pensions";
            }
        } 
        elseif ($_POST['action'] === 'Modifier') {
            if(isset($_POST['idPension']) && !empty($_POST['idPension'])) {
                $idPension = strip_tags($_POST['idPension']);
                $pension = new Pension($idPension, $Tarifs, $LibPension, $DateDebutP, $DateFinP, $RefNumSir, $idCLs[0]);
                
                if($pension->edit()) {
                    $_SESSION['message'] = "Pension modifiée avec succès";
                } else {
                    $_SESSION['erreur'] = "Erreur lors de la modification de la pension";
                }
            } else {
                $_SESSION['erreur'] = "ID de pension manquant pour la modification";
            }
        }

        // Redirection vers la page de liste
        header('Location: ../../../Vue/vue_pension.php');
        die();

    } else {
        // Message d'erreur si le formulaire est incomplet
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: ../../../Vue/vue_pension.php');
        die();
    }
} else {
    // Message d'erreur si aucune donnée POST n'est reçue
    $_SESSION['erreur'] = "Aucune donnée reçue";
    header('Location: ../../../Vue/vue_pension.php');
    die();
} 