<?php
// Par Quentin Mitou

// On importe la connexion PDO
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Prend
{
    private $refidcava;
    private $refidpen;

    public function __construct($refidcava, $refidpen)
    {
        $this->refidcava = $refidcava;
        $this->refidpen = $refidpen;
    }

    // Getters
    public function getRefcava()
    {
        return $this->refidcava;
    }

    public function getRefpen()
    {
        return $this->refidpen;
    }

    // Méthode pour récupérer tous les inscrits
    public function prend_all(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select RefIdCava,RefIdPen from prend where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    // Méthode pour récupérer un inscrit par son id
    public function prend_id($refidcava, $refidpen){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select RefIdCava,RefIdPen from prend where RefIdCava = :RefIdCava AND RefIdPen = :RefIdPen";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdPen', $refidpen, PDO::PARAM_INT);
        $req->bindParam(':RefIdCava', $refidcava, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer le nom du cavalier
    public function getCavalierPrend($refidcava){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "SELECT NomCavalier FROM cavalier WHERE idCavalier = :RefIdCava";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdCava', $refidcava, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne la valeur de la colonne NomCavalier
        return $ligne["NomCavalier"];
    }

    // Méthode pour récupérer le nom du cours
    public function getPensionPrend($refidpen){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "SELECT Libpension FROM pension WHERE idPension = :RefIdPen";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdPen', $refidpen, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        return $ligne["Libpension"];
    }

    // Méthode pour ajouter un inscrit
    public function add(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Insert into prend (RefIdCava, RefIdPen) values (:RefIdCava, :RefIdPen)";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdCava', $this->refidcava, PDO::PARAM_INT);
        $req->bindParam(':RefIdPen', $this->refidpen, PDO::PARAM_INT);
        //On exécute la requête
        if (!$req->execute()) {
            // Afficher l'erreur
            $errorInfo = $req->errorInfo();
            echo "Erreur SQL : " . $errorInfo[2];
            return false;
        }
        return true;
    }

    // Méthode pour modifier un inscrit
    public function edit($id1, $id2) {
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update prend set RefIdPen = :RefIdPen, RefIdCava = :RefIdCava where RefIdCava = :id1 and RefIdPen = :id2";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdPen', $this->refidpen, PDO::PARAM_INT);
        $req->bindParam(':RefIdCava', $this->refidcava, PDO::PARAM_INT);
        $req->bindParam(':id1', $id1, PDO::PARAM_INT);
        $req->bindParam(':id2', $id2, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    // Méthode pour supprimer un inscrit
    public function delete(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update prend set Supprime = 1 where RefIdCava = :RefIdCava and RefIdPen = :RefIdPen";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdCava', $this->refidcava, PDO::PARAM_INT);
        $req->bindParam(':RefIdPen', $this->refidpen, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    public function delete_idPen($id){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update prend set Supprime = 1 where RefIdPen = :RefIdPen";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefIdPen', $id, PDO::PARAM_INT);
        return $req->execute();
    }
}
