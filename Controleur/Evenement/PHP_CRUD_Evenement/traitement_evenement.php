<?php
session_start();
require_once __DIR__ . '/../../../Class/class_evenement.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $evenement = new Evenement("", "", "");

    // Traitement de la suppression de photo
    if ($action === 'delete_photo') {
        if (isset($_POST['photo_id']) && isset($_POST['id'])) {
            $photo_id = strip_tags($_POST['photo_id']);
            $id = strip_tags($_POST['id']);
            $evenement = new Evenement($id, "", "");
            
            if($evenement->deleteimg($photo_id, $id)) {
                $_SESSION['message'] = "Photo supprimée avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression de la photo";
            }
            header('Location: ../../../Vue/vue_evenement.php?id=' . $id . '&action=Modifier');
            die();
        }
    }

    // Traitement de la suppression d'un événement
    if ($action === 'Supprimer') {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $evenement = new Evenement($id, "", "");
            
            if($evenement->delete()) {
                $_SESSION['message'] = "Événement supprimé avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression de l'événement";
            }
        } else {
            $_SESSION['erreur'] = "ID d'événement manquant pour la suppression";
        }
        header('Location: ../../../Vue/vue_evenement.php');
        die();
    }

    // Vérification des champs requis
    $requiredFields = ['TitreE', 'CommentaireE'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $_SESSION['erreur'] = "Le champ " . $field . " est requis";
            header('Location: ../../../Vue/vue_evenement.php');
            die();
        }
    }

    // Nettoyage des données
    $TitreE = strip_tags($_POST['TitreE']);
    $CommentaireE = strip_tags($_POST['CommentaireE']);

    // Traitement selon l'action
    if ($action === 'Ajouter') {
        $evenement = new Evenement("", $TitreE, $CommentaireE);
        
        if($evenement->add()) {
            $idEvenement = $evenement->evenementMax();
            
            // Gestion des photos pour l'ajout
            if (isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto']['name'][0])) {
                foreach ($_FILES['LibPhoto']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['LibPhoto']['error'][$key] === 0) {
                        $fileData = [
                            'name' => $_FILES['LibPhoto']['name'][$key],
                            'tmp_name' => $tmp_name,
                            'error' => $_FILES['LibPhoto']['error'][$key],
                            'size' => $_FILES['LibPhoto']['size'][$key],
                            'type' => $_FILES['LibPhoto']['type'][$key]
                        ];
                        $evenement->evenement_photo_add($fileData, $idEvenement);
                    }
                }
            }
            $_SESSION['message'] = "Événement ajouté avec succès";
        } else {
            $_SESSION['erreur'] = "Erreur lors de l'ajout de l'événement";
        }
    } 
    elseif ($action === 'Modifier') {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $evenement = new Evenement($id, $TitreE, $CommentaireE);
            
            if($evenement->edit()) {
                // Gestion des photos pour la modification - ajout des nouvelles photos sans supprimer les existantes
                if (isset($_FILES['LibPhoto']) && !empty($_FILES['LibPhoto']['name'][0])) {
                    foreach ($_FILES['LibPhoto']['tmp_name'] as $key => $tmp_name) {
                        if ($_FILES['LibPhoto']['error'][$key] === 0) {
                            $fileData = [
                                'name' => $_FILES['LibPhoto']['name'][$key],
                                'tmp_name' => $tmp_name,
                                'error' => $_FILES['LibPhoto']['error'][$key],
                                'size' => $_FILES['LibPhoto']['size'][$key],
                                'type' => $_FILES['LibPhoto']['type'][$key]
                            ];
                            $evenement->evenement_photo_add($fileData, $id);
                        }
                    }
                }
                $_SESSION['message'] = "Événement modifié avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la modification de l'événement";
            }
        } else {
            $_SESSION['erreur'] = "ID d'événement manquant pour la modification";
        }
    }

    header('Location: ../../../Vue/vue_evenement.php');
    die();
} else {
    $_SESSION['erreur'] = "Aucune donnée reçue";
    header('Location: ../../../Vue/vue_evenement.php');
    die();
} 