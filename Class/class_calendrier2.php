<?php
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

            return array_map(function ($event) {
                $title = $event['nomCours'] . ' (' . $event['jour'] . ' ' . $event['HD'] . '-' . $event['HF'] . ')';
                return [
                    'id' => $event['idCourSeance'],
                    'idCours' => $event['idCoursCours'],
                    'title' => $title,
                    'start' => $event['DateCours'],
                    'allDay' => true
                ];
            }, $events);
        } catch (Exception $e) {
            error_log('Erreur dans getEvents : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la récupération des événements : ' . $e->getMessage()];
        }
    }

    public function getAvailableCourses() {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            $SQL = "SELECT idCours, LibCours, jour, HD, HF FROM cours WHERE Supprime = 0";
            $req = $Con->prepare($SQL);
            $req->execute();
            $courses = $req->fetchAll(PDO::FETCH_ASSOC);

            return ['success' => true, 'data' => $courses];
        } catch (Exception $e) {
            error_log('Erreur dans getAvailableCourses : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la récupération des cours : ' . $e->getMessage()];
        }
    }

    public function addEvent($idCours, $dateCours) {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            // Vérifier si le cours existe et n'est pas supprimé
            $SQL = "SELECT idCours FROM cours WHERE idCours = :idCours AND Supprime = 0";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->execute();
            if (!$stmt->fetch()) {
                throw new Exception('Le cours spécifié n\'existe pas ou est supprimé');
            }

            $SQL = "INSERT INTO calendrier (idCoursCours, DateCours) VALUES (:idCours, :dateCours)";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->bindParam(':dateCours', $dateCours, PDO::PARAM_STR);
            $stmt->execute();

            return ['success' => true, 'message' => 'Événement ajouté avec succès'];
        } catch (Exception $e) {
            error_log('Erreur dans addEvent : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'événement : ' . $e->getMessage()];
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

    public function updateEvent($idCourSeance, $idCours, $dateCours) {
        try {
            $Con = connexionPDO();
            if (!$Con) {
                throw new Exception('Échec de la connexion à la base de données');
            }

            // Vérifier si le cours existe et n'est pas supprimé
            $SQL = "SELECT idCours FROM cours WHERE idCours = :idCours AND Supprime = 0";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->execute();
            if (!$stmt->fetch()) {
                throw new Exception('Le cours spécifié n\'existe pas ou est supprimé');
            }

            $SQL = "UPDATE calendrier SET idCoursCours = :idCours, DateCours = :dateCours WHERE idCourSeance = :idCourSeance";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCourSeance', $idCourSeance, PDO::PARAM_INT);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->bindParam(':dateCours', $dateCours, PDO::PARAM_STR);
            $stmt->execute();

            return ['success' => true, 'message' => 'Événement mis à jour avec succès'];
        } catch (Exception $e) {
            error_log('Erreur dans updateEvent : ' . $e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la mise à jour de l\'événement : ' . $e->getMessage()];
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

// Supprimer le déclencheur au démarrage
$calendrier->removeTrigger();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            if (!isset($_POST['idCours']) || !isset($_POST['dateCours'])) {
                echo json_encode(['success' => false, 'message' => 'Paramètres idCours ou dateCours manquants']);
                exit;
            }
            echo json_encode($calendrier->addEvent((int)$_POST['idCours'], $_POST['dateCours']));
            break;

        case 'update':
            if (!isset($_POST['idCourSeance']) || !isset($_POST['idCours']) || !isset($_POST['dateCours'])) {
                echo json_encode(['success' => false, 'message' => 'Paramètres idCourSeance, idCours ou dateCours manquants']);
                exit;
            }
            echo json_encode($calendrier->updateEvent((int)$_POST['idCourSeance'], (int)$_POST['idCours'], $_POST['dateCours']));
            break;

        case 'delete':
            if (!isset($_POST['idCourSeance'])) {
                echo json_encode(['success' => false, 'message' => 'Paramètre idCourSeance manquant']);
                exit;
            }
            echo json_encode($calendrier->deleteEvent((int)$_POST['idCourSeance']));
            break;

        case 'getCourses':
            echo json_encode($calendrier->getAvailableCourses());
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
            break;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode($calendrier->getEvents());
}
?>