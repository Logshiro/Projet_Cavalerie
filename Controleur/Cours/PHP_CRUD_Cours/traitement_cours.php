<?php
session_start();
require_once __DIR__ . '/../../../Class/class_cours.php';
require_once __DIR__ . '/../../../Class/class_inscrit.php';
require_once __DIR__ . '/../../../Class/class_participe.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $cours = new Cours("", "", "", "", "", "");

    // Traitement de la suppression d'un cours
    if ($action === 'Supprimer') {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $cours = new Cours($id, "", "", "", "", "");
            
            // Suppression des inscriptions associées
            $inscrit = new Inscrit("", $id);
            $inscrit->delete_idCours($id);
            
            // Suppression des participations associées
            $participe = new Participe("", $id, "");
            $participe->delete_idCours($id);
            
            // Suppression du cours
            if($cours->delete($id)) {
                $_SESSION['message'] = "Cours supprimé avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression du cours";
            }
        } else {
            $_SESSION['erreur'] = "ID de cours manquant pour la suppression";
        }
        header('Location: ../../../Vue/vue_cours.php');
        die();
    }

    // Traitement de la suppression des inscription et participation
    if ($action === 'delete_inscrit') {
        if(isset($_POST['id']) && !empty($_POST['id'] &&
         isset($_POST['idC']) && !empty($_POST['idC']))) {
            $idCava = strip_tags($_POST['idC']);
            $idCours = strip_tags($_POST['id']);
            
            // Suppression des inscriptions associées
            $inscrit = new Inscrit($idCava, $idCours);
            $success1 = $inscrit->delete();
            
            // Suppression des participations associées
            $participe = new Participe("", $idCours, $idCava,"");
            $success2 = $participe->delete_idCava();
            
            if($success1 && $success2){
                $_SESSION['message'] = "Cours supprimé avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression des inscriptions ou des participations";
            }
            
        } else {
            $_SESSION['erreur'] = "ID de cours ou cavalier manquant pour la suppression";
        }
        header('Location: ../../../Vue/vue_cours.php?id=' . $idCours . '&action=Modifier');
        die();
    }

    // Vérification des champs requis
    $requiredFields = ['Libcours', 'jour', 'HD', 'HF', 'idGalop'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $_SESSION['erreur'] = "Le champ " . $field . " est requis";
            header('Location: ../../../Vue/vue_cours.php');
            die();
        }
    }

    // Nettoyage des données
    $Libcours = strip_tags($_POST['Libcours']);
    $jour = strip_tags($_POST['jour']);
    $HD = strip_tags($_POST['HD']);
    $HF = strip_tags($_POST['HF']);
    $RefGalop = strip_tags($_POST['idGalop']);

    // Traitement selon l'action
    if ($action === 'Ajouter') {
        try {
            // Création du cours
            $cours = new Cours("", $Libcours, $jour, $HD, $HF, $RefGalop);
            $success = $cours->add();
            
            if (!$success) {
                throw new Exception("Erreur lors de l'ajout du cours dans la base de données");
            }
            
            // Récupération de l'ID du cours créé
            $idCours = $cours->CoursMax();
            if (!$idCours) {
                throw new Exception("Impossible de récupérer l'ID du cours créé");
            }
            
            // Création des séances pour le cours (2 séances pour commencer)
            $idSeances = $cours->getCoursAssADD($idCours, 2);
            if (empty($idSeances)) {
                throw new Exception("Erreur lors de la création des séances");
            }

            // Vérification que les séances existent dans la table calendrier
            if (!$cours->getallSeanceCours($idCours)) {
                throw new Exception("Les séances n'ont pas été correctement créées dans le calendrier");
            }

            if (isset($_POST['idCL']) && is_array($_POST['idCL'])) {
                // Filtrer les cavaliers valides (non vides)
                $cavaliersValid = array_filter($_POST['idCL'], function($cav) {
                    return !empty(trim($cav));
                });
                if (!empty($cavaliersValid)) {
                    // Ajout des inscriptions pour les cavaliers
                    if (isset($_POST['idCL']) && is_array($_POST['idCL'])) {
                        foreach ($_POST['idCL'] as $RefCavalier) {
                            $cleanRefCavalier = strip_tags($RefCavalier);
                            
                            // Inscription du cavalier au cours
                            $inscrit = new Inscrit($cleanRefCavalier, $idCours);
                            if (!$inscrit->add()) {
                                throw new Exception("Erreur lors de l'inscription du cavalier");
                            }
                            
                            // Ajout des participations pour chaque séance
                            foreach ($Seances as $seance) {
                                $participe = new Participe($seance['idCourSeance'], $idCours, $cleanRefCavalier, true);
                                if (!$participe->add($seance['idCourSeance'], $idCours, $cleanRefCavalier)) {
                                    throw new Exception("Erreur lors de l'ajout de la participation");
                                }
                            }
                        }
                    }
                }
            }
            
            $_SESSION['message'] = "Cours ajouté avec succès";
            
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
            // Si le cours a été créé mais qu'il y a eu une erreur après, on le supprime
            if (isset($idCours)) {
                $cours->delete($idCours);
            }
        }
    } 
    elseif ($action === 'Modifier') {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $cours = new Cours($id, $Libcours, $jour, $HD, $HF, $RefGalop);
            var_dump($id, $Libcours, $jour, $HD, $HF, $RefGalop);
            if($cours->edit()) {
                // Mise à jour des inscriptions
                if (isset($_POST['idCL']) && is_array($_POST['idCL'])) {
                    // Filtrer les cavaliers valides (non vides)
                    $cavaliersValid = array_filter($_POST['idCL'], function($cav) {
                        return !empty(trim($cav));
                    });
                
                    if (!empty($cavaliersValid)) {
                        foreach ($cavaliersValid as $RefCavalier) {
                            $cleanRefCavalier = strip_tags($RefCavalier);
                            $inscrit = new Inscrit($cleanRefCavalier, $id);
                            $inscrit->add($cleanRefCavalier, $id);
                
                            // Ajout participations
                            $idSeances = $cours->getallSeanceCours($id);
                            if (!empty($idSeances)) {
                                foreach ($idSeances as $idSeance) {
                                    $participe = new Participe($idSeance['idCourSeance'], $id, $cleanRefCavalier, true);
                                    $participe->add($idSeance['idCourSeance'], $id, $cleanRefCavalier);
                                }
                            }
                        }
                    }
                }
                $_SESSION['message'] = "Cours modifié avec succès";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la modification du cours";
            }
        } else {
            $_SESSION['erreur'] = "ID de cours manquant pour la modification";
        }
    }

    header('Location: ../../../Vue/vue_cours.php');
    die();
} else {
    $_SESSION['erreur'] = "Aucune donnée reçue";
    header('Location: ../../../Vue/vue_cours.php');
    die();
} 