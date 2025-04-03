<?php
include_once __DIR__ . '/../PDO/bdd.inc.php';
class Robe
{
    private $idrobe;
    private $librobe;


    public function __construct($idrobe,$librobe)
    {
        $this->idrobe = $idrobe;
        $this->librobe = $librobe;
    }

    // Getters
    public function getidrobe()
    {
        return $this->idrobe;
    }

    public function getlibrobe()
    {
        return $this->librobe;
    }

    // Setters
    public function setlibrobe($librobe)
    {
        $this->librobe = $librobe;
    }
    
    //Fonction pour récupérer tous les enregistrements
    public function robe_all(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idRobe,LibRobe,Supprime from robe where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;  
    }

    //Fonction pour récupérer un enregistrement
    public function robe_id($idRobe){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idRobe,LibRobe,Supprime from robe where idRobe = :idRobe";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idRobe', $idRobe, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //Fonction pour modifier un enregistrement
    public function edit(){

        $Con = connexionPDO(); // Connection PDO
        //On prépare la requête
        $SQL = "UPDATE Robe SET LibRobe = :LibRobe WHERE idRobe = :idRobe";
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $req->bindParam(':idRobe', $this->idrobe, PDO::PARAM_INT);
        $req->bindParam(':LibRobe', $this->librobe, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour ajouter un enregistrement
    public function add(){
        $Con = connexionPDO(); // Connection PDO
        //On prépare la requête
        $SQL = "INSERT INTO `robe` (`LibRobe`) VALUES (:LibRobe)";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $req->bindParam(':LibRobe', $this->librobe, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute(); 

    }

    //Fonction pour supprimer un enregistrement
    public function delete($id){
        $Con = connexionPDO(); // Connection PDO
        //On prépare la requête
        $SQL = "UPDATE Robe SET Supprime = 1 WHERE idRobe = :idRobe";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $req->bindParam(':idRobe', $id, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';
