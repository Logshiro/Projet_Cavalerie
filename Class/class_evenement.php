<?php
//On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Evenement
{
    private $IdEvenement;
    private $titre;
    private $CommentaireE;

    public function __construct($IdEvenement, $titre, $CommentaireE)
    {
        $this->IdEvenement = $IdEvenement;
        $this->titre = $titre;
        $this->CommentaireE = $CommentaireE;
    }

    // Getters
    public function getIdEvenement()
    {
        return $this->IdEvenement;
    }

    public function getTitreE()
    {
        return $this->titre;
    }

    public function getCommentaireE()
    {
        return $this->CommentaireE;
    }

    // Setters

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setCommentaireE($CommentaireE)
    {
        $this->CommentaireE = $CommentaireE;
    }

    //Fonction pour récupérer tous les enregistrements
    public function Evenement_All(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idEvenement,TitreE,CommentaireE,Supprime from evenement where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        // recupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetchall();
        //On retourne le résultat
        return $resultat;  
    }

    //Fonction pour récupérer un enregistrement par son id
    public function evenement_id($id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idEvenement,TitreE,CommentaireE from evenement where idEvenement = :idEvenement";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idEvenement', $id, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        // recupère le 1° enregistrement sous forme de tableau
        return $req->fetch();
    }   
    
    public function evenement_photo1($id) {
        $Con = connexionPDO();
        $SQL = "SELECT LibPhoto, idPhoto FROM photo WHERE RefEvenement = :idEvenement AND Supprime = 0";
        $req = $Con->prepare($SQL);
        $req->bindParam(':idEvenement', $id, PDO::PARAM_INT);
        $req->execute();
        $photos = $req->fetchAll(PDO::FETCH_ASSOC);
        
        // Use absolute path
        foreach ($photos as &$photo) {
            $photo['LibPhoto'] = '/gestion_centre_equestre-ProjectC2' . $photo['LibPhoto'];
        }
        
        return $photos;
    }
    public function evenement_photo($id){
        $Con = connexionPDO();
        $SQL = "SELECT LibPhoto, idPhoto FROM photo WHERE RefEvenement = :idEvenement AND Supprime = 0";
        $req = $Con->prepare($SQL);
        $req->bindParam(':idEvenement', $id, PDO::PARAM_INT);
        $req->execute();
        $photos = $req->fetchAll(PDO::FETCH_ASSOC);
        
        // Construire le chemin complet pour chaque photo
        foreach ($photos as &$photo) {
            $photo['LibPhoto'] = '../' . $photo['LibPhoto'];
        }
        
        return $photos;
    }

    public function evenement_photo_add($file, $id){
        // Vérifier si le fichier est une image valide
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Type de fichier non autorisé');
        }

        // Définir le chemin absolu du dossier de destination
        $uploadDir = __DIR__ . '/../Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/';
        
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
        $dbPath = '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/' . $fileName;
        
        // Déplacer le fichier uploadé
        if(move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Définir les permissions du fichier à 777
            chmod($targetPath, 0777);
            
            $Con = connexionPDO();
            $SQL = "INSERT INTO photo (LibPhoto, RefEvenement) VALUES (:LibPhoto, :Evenement)";
            $req = $Con->prepare($SQL);
            $req->bindParam(':LibPhoto', $dbPath, PDO::PARAM_STR);
            $req->bindParam(':Evenement', $id, PDO::PARAM_INT);
            return $req->execute();
        } else {
            throw new Exception('Échec du téléchargement de l\'image');
        }
    }

    public function evenementMax() {
        $Con = connexionPDO();
        try {
            $SQL = "SELECT MAX(idEvenement) as maxId FROM evenement";
            $req = $Con->prepare($SQL);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
            return $resultat['maxId'] ?? 0; // Retourne 0 si aucun résultat
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du max NumSir: " . $e->getMessage());
            return 0;
        }
    }

    //Fonction pour modifier un enregistrement
    public function edit(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE evenement SET TitreE = :TitreE, CommentaireE = :CommentaireE
                    WHERE idEvenement = :idEvenement";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idEvenement', $this->IdEvenement, PDO::PARAM_INT);
        $req->bindParam(':TitreE', $this->titre, PDO::PARAM_STR);
        $req->bindParam(':CommentaireE', $this->CommentaireE, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour ajouter un enregistrement
    public function add(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "INSERT INTO `evenement` (`TitreE`,`CommentaireE`) VALUES (:TitreE, :CommentaireE)";
        //On prépare la requête
        $req = $Con->prepare($SQL);

        //variables php -> sql
        //On lie les paramètres
        $req->bindParam(':TitreE', $this->titre, PDO::PARAM_STR);
        $req->bindParam(':CommentaireE', $this->CommentaireE, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour supprimer un enregistrement
    public function delete(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE evenement SET Supprime = 1 WHERE idEvenement = :idEvenement";
        $req = $Con->prepare($SQL);

        //variables php -> sql
        $req->bindValue(':idEvenement', $this->IdEvenement, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    public function deleteimg($photo_id, $idEvenement) {

        // Supprimer le fichier physique
        $filePath = __DIR__ . '/../Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/' . $photo_id;
        
        if (file_exists($filePath)) {
            unlink($filePath);
            }

            // Correction de la requête UPDATE
            $Con = connexionPDO();
            $SQL = "UPDATE photo SET Supprime = 1 WHERE idPhoto = :idPhoto AND RefEvenement = :RefEvenement";
            $req = $Con->prepare($SQL);
        $req->bindParam(':idPhoto', $photo_id, PDO::PARAM_INT);
        $req->bindParam(':RefEvenement', $idEvenement, PDO::PARAM_INT);
        return $req->execute();
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';
