<?php
session_start();
require_once '../../../Class/class_inscrit.php';

// Vérification si le formulaire est envoyé
if($_POST){
    // Traitement de la suppression
    if ($_POST['action'] === 'Supprimer') {
        if(isset($_POST['idCavalier']) && !empty($_POST['idCavalier']) && 
           isset($_POST['idCours']) && !empty($_POST['idCours'])) {
            $idCavalier = strip_tags($_POST['idCavalier']);
            $idCours = strip_tags($_POST['idCours']);
            $inscrit = new Inscrit($idCavalier, $idCours);
            
            if($inscrit->delete()) {
                $_SESSION['message'] = "Inscription supprimée avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression de l'inscription";
            }
        } else {
            $_SESSION['erreur'] = "Données manquantes pour la suppression";
        }
        header('Location: ../../../Vue/vue_inscrit.php');
        die();
    }

    // Vérification si tous les champs requis sont remplis pour l'ajout et la modification
    if(isset($_POST['idCL']) && !empty($_POST['idCL']) && 
       isset($_POST['idCours']) && !empty($_POST['idCours'])) {

        // Nettoyage des données
        $RefCavalier = strip_tags($_POST['idCL']);
        $RefCours = strip_tags($_POST['idCours']);

        // Traitement selon l'action
        if ($_POST['action'] === 'Ajouter') {
            $inscrit = new Inscrit($RefCavalier, $RefCours);
            if ($inscrit->inscrit_id($RefCavalier, $RefCours) == null){
                if($inscrit->add()) {
                    $_SESSION['message'] = "Inscription ajoutée avec succès";
                } else {
                    $_SESSION['erreur'] = "Erreur lors de l'ajout de l'inscription";
                }
            } else {
                $_SESSION['erreur'] = "déjàt inscrit";
            }
        } 
        elseif ($_POST['action'] === 'Modifier') {
            if(isset($_POST['idCavalier_old']) && !empty($_POST['idCavalier_old']) && 
               isset($_POST['idCours_old']) && !empty($_POST['idCours_old'])) {
                $oldCavalier = strip_tags($_POST['idCavalier_old']);
                $oldCours = strip_tags($_POST['idCours_old']);
                
                $inscrit = new Inscrit($RefCavalier, $RefCours);
                if ($inscrit->inscrit_id($RefCavalier, $RefCours) == null){
                    if($inscrit->edit($oldCavalier, $oldCours)) {
                        $_SESSION['message'] = "Inscription modifiée avec succès";
                    } else {
                        $_SESSION['erreur'] = "Erreur lors de la modification de l'inscription";
                    }
                } else {
                    $_SESSION['erreur'] = "déjàt inscrit";
                }
            } else {
                $_SESSION['erreur'] = "Données manquantes pour la modification";
            }
        }

        // Redirection vers la page de liste
        header('Location: ../../../Vue/vue_inscrit.php');
        die();

    } else {
        // Message d'erreur si le formulaire est incomplet
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: ../../../Vue/vue_inscrit.php');
        die();
    }
} else {
    // Message d'erreur si aucune donnée POST n'est reçue
    $_SESSION['erreur'] = "Aucune donnée reçue";
    header('Location: ../../../Vue/vue_inscrit.php');
    die();
} 