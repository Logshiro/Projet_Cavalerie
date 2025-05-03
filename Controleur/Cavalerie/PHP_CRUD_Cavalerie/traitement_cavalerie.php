<?php
session_start();
require_once __DIR__ . '/../../../Class/class_cavalerie.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $cavalerie = new Cavalerie("", "", "", "", "", "");

    // Traitement de la suppression de photo
    if ($action === 'delete_photo') {
        if (isset($_POST['photo_id']) && isset($_POST['id'])) {
            $photo_id = strip_tags($_POST['photo_id']);
            $id = strip_tags($_POST['id']);
            $cavalerie = new Cavalerie($id, "", "", "", "", "");
            
            if($cavalerie->deleteimg($photo_id, $id)) {
                $_SESSION['message'] = "Photo supprimée avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression de la photo";
            }
            header('Location: ../../../Vue/vue_cavalerie.php?id=' . $id . '&action=Modifier');
            die();
        }
    }

    // Traitement de la suppression d'une cavalerie
    if ($action === 'Supprimer') {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $cavalerie = new Cavalerie($id, "", "", "", "", "");
            
            if($cavalerie->delete($id)) {
                $_SESSION['message'] = "Cavalerie supprimée avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression de la cavalerie";
            }
        } else {
            $_SESSION['erreur'] = "ID de cavalerie manquant pour la suppression";
        }
        header('Location: ../../../Vue/vue_cavalerie.php');
        die();
    }

    // Vérification des champs requis
    $requiredFields = ['NomCheval', 'DateNC', 'Garot', 'idRace', 'idRobe'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $_SESSION['erreur'] = "Le champ " . $field . " est requis";
            header('Location: ../../../Vue/vue_cavalerie.php');
            die();
        }
    }

    // Nettoyage des données
    $NomCheval = strip_tags($_POST['NomCheval']);
    $DateNC = strip_tags($_POST['DateNC']);
    $Garot = strip_tags($_POST['Garot']);
    $RefRace = strip_tags($_POST['idRace']);
    $RefRobe = strip_tags($_POST['idRobe']);

    // Traitement selon l'action
    if ($action === 'Ajouter') {
        $cavalerie = new Cavalerie("", $NomCheval, $DateNC, $Garot, $RefRace, $RefRobe);
        
        if($cavalerie->add()) {
            $idCavalerie = $cavalerie->cavalerieMax();
            
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
                        $cavalerie->cavalerie_photo_add($fileData, $idCavalerie);
                    }
                }
            }
            $_SESSION['message'] = "Cavalerie ajoutée avec succès";
        } else {
            $_SESSION['erreur'] = "Erreur lors de l'ajout de la cavalerie";
        }
    } 
    elseif ($action === 'Modifier') {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $cavalerie = new Cavalerie($id, $NomCheval, $DateNC, $Garot, $RefRace, $RefRobe);
            
            if($cavalerie->update()) {
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
                            $cavalerie->cavalerie_photo_add($fileData, $id);
                        }
                    }
                }
                $_SESSION['message'] = "Cavalerie modifiée avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la modification de la cavalerie";
            }
        } else {
            $_SESSION['erreur'] = "ID de cavalerie manquant pour la modification";
        }
    }

    header('Location: ../../../Vue/vue_cavalerie.php');
    die();
} else {
    $_SESSION['erreur'] = "Aucune donnée reçue";
    header('Location: ../../../Vue/vue_cavalerie.php');
    die();
} 