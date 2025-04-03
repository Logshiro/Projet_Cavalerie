<?php
// Par Quentin Mitou

//On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';
include_once __DIR__ . '/../modele/fonction/fonction.php';

class Cavalerie 
{
    private $numsir;
    private $nomcheval;
    private $dateNC;
    private $garot;
    private $refrace;
    private $refrobe;

    public function __construct($numsir, $nomcheval, $dateNC, $garot, $refrace, $refrobe)
    {
        $this->numsir = $numsir;
        $this->nomcheval = $nomcheval;
        $this->dateNC = $dateNC;
        $this->garot = $garot;
        $this->refrace = $refrace;
        $this->refrobe = $refrobe;
    }

    // Getters
    public function getNumsir()
    {
        return $this->numsir;
    }

    public function getNomcheval()
    {
        return $this->nomcheval;
    }

    public function getDateNC()
    {
        return $this->dateNC;
    }

    public function getGarot()
    {
        return $this->garot;
    }

    public function getRefrace()
    {
        return $this->refrace;
    }

    public function getRefrobe()
    {
        return $this->refrobe;
    }

    // Setters

    public function setNomcheval($nomcheval)
    {
        $this->nomcheval = $nomcheval;
    }

    public function setDateNC($dateNC)
    {
        $this->dateNC = $dateNC;
    }

    public function setGarot($garot)
    {
        $this->garot = $garot;
    }

    public function setRefrace($refrace)
    {
        $this->refrace = $refrace;
    }

    public function setRefrobe($refrobe)
    {
        $this->refrobe = $refrobe;
    }

    //Fonction pour récupérer tous les enregistrements
    public function cavalerie_all(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select NumSir,NomCheval,DateNC,Garot,RefRace ,RefRobe ,Supprime from cavalerie where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;  
    }

    //Fonction pour récupérer un enregistrement
    public function cavalerie_id($id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT  * FROM cavalerie WHERE NumSir = :NumSir";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':NumSir', $id, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        return $ligne;
    }

    public function cavalerie_photo($id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT LibPhoto,idPhoto FROM photo WHERE RefNumsir = :Numsir AND Supprime = 0";
        $req = $Con->prepare($SQL);
        $req->bindParam(':Numsir', $id, PDO::PARAM_INT);
        $req->execute();
        $photos = $req->fetchAll(PDO::FETCH_ASSOC);
        
        // Construire le chemin complet pour chaque photo
        foreach ($photos as &$photo) {
            $photo['LibPhoto'] = '../' . $photo['LibPhoto'];
        }
        
        return $photos;
    }

    public function cavalerie_photo_add($file, $id){
        // Vérifier si le fichier est une image valide
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Type de fichier non autorisé');
        }

        // Définir le chemin absolu du dossier de destination
        $uploadDir = __DIR__ . '/../Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/';
        
        // Créer le dossier de manière récursive s'il n'existe pas
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception('Impossible de créer le dossier uploads');
            }
            chmod($uploadDir, 0777);
        }
        
        // Générer un nom de fichier unique et sécurisé
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '_' . hash('sha256', basename($file['name'])) . '.' . $extension;
        $targetPath = $uploadDir . $fileName;
        
        // Chemin relatif pour la base de données
        $dbPath = '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/' . $fileName;
        
        // Déplacer le fichier uploadé
        if(move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Définir les permissions du fichier à 777
            chmod($targetPath, 0777);
            
            $Con = connexionPDO();
            $SQL = "INSERT INTO photo (LibPhoto, RefNumsir) VALUES (:LibPhoto, :Numsir)";
            $req = $Con->prepare($SQL);
            $req->bindParam(':LibPhoto', $dbPath, PDO::PARAM_STR);
            $req->bindParam(':Numsir', $id, PDO::PARAM_INT);
            return $req->execute();
        } else {
            throw new Exception('Échec du téléchargement de l\'image');
        }
    }

    public function cavalerieMax() {
        $Con = connexionPDO();
        try {
            $SQL = "SELECT MAX(NumSir) as maxId FROM cavalerie";
            $req = $Con->prepare($SQL);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
            return $resultat['maxId'] ?? 0; // Retourne 0 si aucun résultat
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du max NumSir: " . $e->getMessage());
            return 0;
        }
    }

    //Fonction pour récupérer un enregistrement
    public function getCavalerieRace($id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT LibRace FROM race WHERE idRace = :idRace";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $data = [":idRace" => $id];
        //On exécute la requête
        $req->execute($data);
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne la valeur de la colonne LibRace
        return  $ligne['LibRace'];
    }

    //Fonction pour récupérer un enregistrement
    public function getCavalerieRobe($id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT LibRobe FROM robe WHERE idRobe = :idRobe";
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $data = [":idRobe" => $id];
        //On exécute la requête
        $req->execute($data);
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne la valeur de la colonne LibRobex
        return  $ligne['LibRobe'];
    }

    //Fonction pour modifier un enregistrement
    public function update(){
        //Formatage de la date avant la mise à jour
        $formattedDateNC = getFormattedDateForDisplay($this->dateNC);
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE cavalerie SET NomCheval = :NomCheval, DateNC = :DateNC, Garot = :Garot,
        RefRace = :RefRace, RefRobe = :RefRobe WHERE NumSir = :NumSir";
        //On prépare la requête
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":NumSir" => $this->numsir,":NomCheval" =>$this->nomcheval,":DateNC" => 
                $formattedDateNC,":Garot" => $this->garot,":RefRace" => $this->refrace ,":RefRobe"=> $this->refrobe ];
        
        //On exécute la requête
        return $req->execute($data);

    }

    //Fonction pour ajouter un enregistrement
    public function add(){
        //Formatage de la date avant l'insertion
        $formattedDateNC = getFormattedDateForDisplay($this->dateNC);
        $Con = connexionPDO(); // Connection PDO
        $SQL = "INSERT INTO `cavalerie`(`NomCheval`, `DateNC`, `Garot`, `RefRace`, `RefRobe`) VALUES
        (:NomCheval, :DateNC, :Garot, :RefRace , :RefRobe )";
        //On prépare la requête
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":NomCheval" => $this->nomcheval,":DateNC" => $formattedDateNC,":Garot" => 
                $this->garot,":RefRace" => $this->refrace ,":RefRobe" => $this->refrobe];
            
        //On exécute la requête
        return $req->execute($data);
    
    }

    //Fonction pour supprimer un enregistrement
    public function delete($id){
        $Con = connexionPDO();
        $SQL = "UPDATE Cavalerie SET Supprime = 1 WHERE NumSir = :NumSir";
        //On prépare la requête
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $req->bindValue(':NumSir', $id, PDO::PARAM_STR);
        
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour supprimer une photo
    public function deleteimg($photo_lib, $NumSir) {
        // Construire le chemin complet vers le fichier
        $filePath = __DIR__ . '/../Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/' . $photo_lib;
        
        // Supprimer le fichier physique s'il existe
        if (file_exists($filePath)) {
            if (!unlink($filePath)) {
                throw new Exception('Impossible de supprimer le fichier');
            }
        }

        // Supprimer l'entrée de la base de données
        $Con = connexionPDO();
        $SQL = "UPDATE photo SET Supprime = 1 WHERE RefNumsir = :RefNumsir AND idPhoto = :idPhoto";
        $req = $Con->prepare($SQL);
        $data = [":RefNumsir" => $NumSir, ":idPhoto" => $photo_lib];
        return $req->execute($data);
    }

}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';

