<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Calendrier {
    public function getEvents() {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            $SQL = "SELECT 
                        c.idCourSeance,
                        c.idCoursCours,
                        c.DateCours,
                        cours.LibCours AS nomCours,
                        cours.jour,
                        cours.HD,
                        cours.HF
                    FROM calendrier c
                    LEFT JOIN cours ON c.idCoursCours = cours.idCours
                    WHERE c.Supprime = 0";
            $stmt = $Con->prepare($SQL);
            $stmt->execute();
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($events)) {
                error_log('Aucun événement trouvé dans la table calendrier avec Supprime = 0');
                return [];
            }

            $formattedEvents = array_map(function ($event) {
                $title = $event['nomCours'] . ' (' . $event['jour'] . ' ' . $event['HD'] . '-' . $event['HF'] . ')';
                return [
                    'id' => $event['idCourSeance'],
                    'idCours' => $event['idCoursCours'],
                    'title' => $title,
                    'start' => $event['DateCours'],
                    'allDay' => true
                ];
            }, $events);

            error_log('Événements formatés : ' . json_encode($formattedEvents));
            return $formattedEvents;
        } catch (Exception $e) {
            error_log('Erreur dans getEvents : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la récupération des événements : ' . $e->getMessage()];
        }
    }

    public function getRegisteredCavaliers($idCours) {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            $SQL = "SELECT 
                        cavalier.NomCavalier,
                        cavalier.PrenomCavalier
                    FROM inscrit
                    JOIN cavalier ON inscrit.RefCavalier = cavalier.idCavalier
                    WHERE inscrit.RefCours = :idCours
                    AND inscrit.Supprime = 0
                    AND cavalier.Supprime = 0";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->execute();
            $cavaliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['success' => true, 'data' => $cavaliers];
        } catch (Exception $e) {
            error_log('Erreur dans getRegisteredCavaliers : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la récupération des cavaliers : ' . $e->getMessage()];
        }
    }

    public function updateEvent($idCourSeance, $idCours, $libCours, $jour, $HD, $HF, $dateCours) {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            $SQL = "SELECT idCours FROM cours WHERE idCours = :idCours AND Supprime = 0";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->execute();
            if (!$stmt->fetch()) {
                throw new Exception('Le cours spécifié n\'existe pas ou est supprimé');
            }

            $SQL = "UPDATE cours SET LibCours = :libCours, jour = :jour, HD = :HD, HF = :HF WHERE idCours = :idCours";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':libCours', $libCours, PDO::PARAM_STR);
            $stmt->bindParam(':jour', $jour, PDO::PARAM_STR);
            $stmt->bindParam(':HD', $HD, PDO::PARAM_STR);
            $stmt->bindParam(':HF', $HF, PDO::PARAM_STR);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->execute();

            $SQL = "UPDATE calendrier SET DateCours = :dateCours WHERE idCourSeance = :idCourSeance";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':dateCours', $dateCours, PDO::PARAM_STR);
            $stmt->bindParam(':idCourSeance', $idCourSeance, PDO::PARAM_INT);
            $stmt->execute();

            return ['success' => true, 'message' => 'Événement mis à jour avec succès'];
        } catch (Exception $e) {
            error_log('Erreur dans updateEvent : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la mise à jour de l\'événement : ' . $e->getMessage()];
        }
    }

    public function deleteEvent($idCourSeance) {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            $SQL = "UPDATE calendrier SET Supprime = 1 WHERE idCourSeance = :idCourSeance";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCourSeance', $idCourSeance, PDO::PARAM_INT);
            $stmt->execute();

            return ['success' => true, 'message' => 'Événement supprimé avec succès'];
        } catch (Exception $e) {
            error_log('Erreur dans deleteEvent : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la suppression de l\'événement : ' . $e->getMessage()];
        }
    }

    public function removeTrigger() {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            $SQL = "DROP TRIGGER IF EXISTS BU_cavalier";
            $Con->exec($SQL);
            return ['success' => true, 'message' => 'Déclencheur BU_cavalier supprimé avec succès'];
        } catch (Exception $e) {
            error_log('Erreur dans removeTrigger : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la suppression du déclencheur : ' . $e->getMessage()];
        }
    }
}

$calendrier = new Calendrier();

$calendrier->removeTrigger();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'update':
            if (!isset($_POST['idCourSeance']) || !isset($_POST['idCours']) || !isset($_POST['libCours']) || 
                !isset($_POST['jour']) || !isset($_POST['HD']) || !isset($_POST['HF']) || !isset($_POST['dateCours'])) {
                echo json_encode(['success' => false, 'message' => 'Paramètres manquants pour la mise à jour']);
                exit;
            }
            echo json_encode($calendrier->updateEvent(
                (int)$_POST['idCourSeance'],
                (int)$_POST['idCours'],
                $_POST['libCours'],
                $_POST['jour'],
                $_POST['HD'],
                $_POST['HF'],
                $_POST['dateCours']
            ));
            break;

        case 'delete':
            if (!isset($_POST['idCourSeance'])) {
                echo json_encode(['success' => false, 'message' => 'Paramètre idCourSeance manquant']);
                exit;
            }
            echo json_encode($calendrier->deleteEvent((int)$_POST['idCourSeance']));
            break;

        case 'getCavaliers':
            if (!isset($_POST['idCours'])) {
                echo json_encode(['success' => false, 'message' => 'Paramètre idCours manquant']);
                exit;
            }
            echo json_encode($calendrier->getRegisteredCavaliers((int)$_POST['idCours']));
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
            break;
    }
} else {
    echo json_encode($calendrier->getEvents());
}
?>