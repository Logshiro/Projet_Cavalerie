<?php
//On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';
class Galop
{
    private $IdGalop;
    private $LibGalop;

    public function __construct($IdGalop, $LibGalop)
    {
        $this->IdGalop = $IdGalop;
        $this->LibGalop = $LibGalop;
    }

    // Getters
    public function getIdGalop()
    {
        return $this->IdGalop;
    }

    public function getLibGalop()
    {
        return $this->LibGalop;
    }

    // Setters
    public function setLibGalop($LibGalop)
    {
        $this->LibGalop = $LibGalop;
    }

    //Fonction pour récupérer tous les enregistrements
    public function galop_all(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idGalop,LibGalop,Supprime from galop where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        // recupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetchall();
        return $resultat;  
    }

    //Fonction pour récupérer un enregistrement par son id
    public function galop_id($id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idGalop,LibGalop,Supprime from galop where idGalop = :idGalop";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idGalop', $id, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        // recupère le 1° enregistrement sous forme de tableau
        return $req->fetch();
    }   

    //Fonction pour modifier un enregistrement
    public function edit(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE galop SET LibGalop = :LibGalop
            WHERE idGalop = :idGalop";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idGalop', $this->IdGalop, PDO::PARAM_INT);
        $req->bindParam(':LibGalop', $this->LibGalop, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour ajouter un enregistrement
    public function add(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "INSERT INTO `Galop` (`LibGalop`) VALUES (:LibGalop)";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':LibGalop', $this->LibGalop, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour supprimer un enregistrement
    public function delete($id){
        $Con = connexionPDO();
        $SQL = "UPDATE Galop SET Supprime = 1 WHERE idGalop = :idGalop";
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idGalop', $id, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';