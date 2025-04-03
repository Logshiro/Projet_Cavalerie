<?php
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Calendrier {

    private $idCourSeance;
    private $idCoursCours ;
    private $DateCours;

    public function __construct($idCourSeance, $idCoursCours, $DateCours)
    {
        $this->idCourSeance = $idCourSeance;
        $this->idCoursCours = $idCoursCours;
        $this->DateCours = $DateCours;
    }


    public function getEvents() {
        $Con = connexionPDO();
        $SQL = "SELECT 
                    c.idCourSeance,
                    c.idCoursCours,
                    c.DateCours,
                    cours.LibCours AS nomCours
                FROM calendrier c
                LEFT JOIN cours ON c.idCoursCours = cours.idCours
                WHERE c.Supprime = 0";
        $stmt = $Con->prepare($SQL);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($event) {
            return [
                'id' => $event['idCourSeance'],
                'Cour' => $event['idCoursCours'],
                'title' => $event['nomCours'],
                'start' => $event['DateCours'],
                'allDay' => true
            ];
        }, $events);
    }

    public function getCoursInscrit($refcours){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "SELECT Libcours FROM cours WHERE idCours = :RefCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $refcours, PDO::PARAM_INT);
        //On exécute la requête
        if($req->execute()){
            $ligne = $req->fetch(PDO::FETCH_ASSOC);

            // Si aucune ligne n'est trouvée, retourne une chaîne vide ou une valeur par défaut
            return $ligne["Libcours"];
        };
        //On récupère le 1° enregistrement sous forme de tableau
        return null;
    }

    public function addEvent($idCours, $dateCours) {
        try {
            $Con = connexionPDO();
            $SQL = "INSERT INTO calendrier (idCoursCours, DateCours) VALUES (:idCours, :dateCours)";
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
            $stmt->bindParam(':dateCours', $dateCours, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return json_encode(['success' => true]);
            } else {
                throw new Exception('Erreur lors de l\'insertion');
            }
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
    
    public function deleteEvent($idCourSeance) {
        try {
            $Con = connexionPDO();
            $SQL = "UPDATE calendrier set Supprime = 1  WHERE idCourSeance = :idCourSeance"; 
            $stmt = $Con->prepare($SQL);
            $stmt->bindParam(':idCourSeance', $idCourSeance, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return json_encode(['success' => true]);
            } else {
                throw new Exception('Erreur lors de la suppression');
            }
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function updateEvent($idCourSeance, $idCours, $dateCours) {
        $Con = connexionPDO();
        $SQL = "UPDATE calendrier SET idCoursCours = :idCours, DateCours = :dateCours WHERE idCourSeance = :idCourSeance";
        $stmt = $Con->prepare($SQL);
        $stmt->bindParam(':idCourSeance', $idCourSeance, PDO::PARAM_INT);
        $stmt->bindParam(':idCours', $idCours, PDO::PARAM_INT);
        $stmt->bindParam(':dateCours', $dateCours, PDO::PARAM_STR);
        return $stmt->execute();
    }

}

$calendrier = new Calendrier("","","");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'add':
            // Vérification des paramètres
            if (isset($_POST['idCours']) && isset($_POST['dateCours'])) {
                $idCours = $_POST['idCours'];
                $dateCours = $_POST['dateCours'];
                echo json_encode(['success' => $calendrier->addEvent($idCours, $dateCours)]);
            } else {
                echo json_encode(['error' => 'Paramètres manquants']);
            }
            header('Content-Type: application/json');
            break;

        case 'update':
            // Vérification des paramètres
            if (isset($_POST['idCourSeance']) && isset($_POST['idCours']) && isset($_POST['dateCours'])) {
                $idCourSeance = $_POST['idCourSeance'];
                $idCours = $_POST['idCours'];
                $dateCours = $_POST['dateCours'];
                echo json_encode(['success' => $calendrier->updateEvent($idCourSeance, $idCours, $dateCours)]);
            } else {
                echo json_encode(['error' => 'Paramètres manquants']);
            }
            header('Content-Type: application/json');
            break;

        case 'delete':
            // Vérification des paramètres
            if (isset($_POST['idCourSeance'])) {
                $idCourSeance = $_POST['idCourSeance'];
                echo json_encode(['success' => $calendrier->deleteEvent($idCourSeance)]);
            } else {
                echo json_encode(['error' => 'Paramètre idCourSeance manquant']);
            }
            header('Content-Type: application/json');
            break;

        default:
            echo json_encode(['error' => 'Action non reconnue']);
            header('Content-Type: application/json');
            break;
    }
} else {
    // GET request, récupérer tous les événements
    echo json_encode($calendrier->getEvents());
}
?>