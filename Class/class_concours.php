<?php
// On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Concours
{
    private $idconcours;
    private $libconcours;
    private $dateconcours;

    public function __construct($idconcours = null, $libconcours = null, $dateconcours = null)
    {
        if ($idconcours) {
            $this->idconcours = $idconcours;
        }
        if ($libconcours) {
            $this->libconcours = $libconcours;
        }
        if ($dateconcours) {
            $this->dateconcours = $dateconcours;
        }
    }

    // Getters
    public function getIdconcours()
    {
        return $this->idconcours;
    }

    public function getLibconcours()
    {
        return $this->libconcours;
    }

    public function getDateconcours()
    {
        return $this->dateconcours;
    }

    // Setters
    public function setLibconcours($libconcours)
    {
        $this->libconcours = $libconcours;
    }

    public function setDateconcours($dateconcours)
    {
        $this->dateconcours = $dateconcours;
    }

    // CRUD Operations

    // 1. Récupérer tous les concours
    public function getAllConcours()
    {
        $Con = connexionPDO();
        $SQL = "SELECT idConcours, LibConcours, DateConcours FROM concours"; // Pas de filtre "Supprime"
        $req = $Con->prepare($SQL);
        $req->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }

    // 2. Récupérer un concours par son ID
    public function getConcoursById($idconcours)
    {
        $Con = connexionPDO();
        $SQL = "SELECT idConcours, LibConcours, DateConcours FROM concours WHERE idConcours = :idConcours"; // Pas de filtre "Supprime"
        $req = $Con->prepare($SQL);
        $req->execute([":idConcours" => $idconcours]);
        $resultat = $req->fetch();
        return $resultat;
    }

    // 3. Ajouter un concours
    public function addConcours()
    {
        $Con = connexionPDO();
        $SQL = "INSERT INTO concours (LibConcours, DateConcours) VALUES (:LibConcours, :DateConcours)";
        $req = $Con->prepare($SQL);
        $data = [
            ":LibConcours" => $this->libconcours,
            ":DateConcours" => $this->dateconcours
        ];
        $req->execute($data);
        return $Con->lastInsertId(); // Retourne l'ID du concours ajouté
    }

    // 4. Modifier un concours
    public function updateConcours()
    {
        $Con = connexionPDO();
        $SQL = "UPDATE concours SET LibConcours = :LibConcours, DateConcours = :DateConcours WHERE idConcours = :idConcours";
        $req = $Con->prepare($SQL);
        $data = [
            ":idConcours" => $this->idconcours,
            ":LibConcours" => $this->libconcours,
            ":DateConcours" => $this->dateconcours
        ];
        $req->execute($data);
    }

    // 5. Supprimer un concours (supprimer physiquement dans la base)
    public function deleteConcours($idconcours)
    {
        $Con = connexionPDO();
        $SQL = "DELETE FROM concours WHERE idConcours = :idConcours"; // Utilisation de DELETE pour supprimer physiquement un concours
        $req = $Con->prepare($SQL);
        $req->execute([":idConcours" => $idconcours]);
    }

    // 6. Vérifier si un concours existe
    public function checkConcoursExists($idconcours)
    {
        $Con = connexionPDO();
        $SQL = "SELECT COUNT(*) FROM concours WHERE idConcours = :idConcours"; // Pas de condition "Supprime"
        $req = $Con->prepare($SQL);
        $req->bindParam(':idConcours', $idconcours, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn() > 0; // Retourne true si le concours existe
    }

    // 7. Lister les cavaliers inscrits à un concours
    public function getCavaliersByConcours($idconcours)
    {
        $Con = connexionPDO();
        $SQL = "SELECT c.NomCavalier FROM cavalier c
                JOIN inscrit i ON c.idCavalier = i.RefCavalier
                WHERE i.RefConcours = :idConcours";
        $req = $Con->prepare($SQL);
        $req->execute([":idConcours" => $idconcours]);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}

// Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';
?>
