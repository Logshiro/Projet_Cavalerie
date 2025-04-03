<?php
include_once __DIR__ . '/../PDO/bdd.inc.php';
class Race
{
    private $idrace;
    private $librace;


    public function __construct($idrace,$librace)
    {
        $this->idrace = $idrace;
        $this->librace = $librace;
    }

    // Getters
    public function getidrace()
    {
        return $this->idrace;
    }

    public function getlibrace()
    {
        return $this->librace;
    }

    // Setters
    public function setlibrace($librace)
    {
        $this->librace = $librace;
    }

    //Fonction pour récupérer tous les enregistrements
    public function race_all(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idRace,LibRace,Supprime from race where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;  
    }

    //Fonction pour récupérer un enregistrement par son id
    public function race_id(int $id){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idRace,LibRace,Supprime from race where idRace = :idRace";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idRace', $id, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère l'enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //Fonction pour modifier un enregistrement
    public function edit(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE Race SET LibRace = :LibRace WHERE idRace = :idRace";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idRace', $this->idrace, PDO::PARAM_INT);
        $req->bindParam(':LibRace', $this->librace, PDO::PARAM_STR);
        //On exécute la requête     
        return $req->execute();
    }
    //Fonction pour ajouter un enregistrement
    public function add(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "INSERT INTO `race` (`LibRace`) VALUES (:LibRace)";
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':LibRace', $this->librace, PDO::PARAM_STR);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour supprimer un enregistrement
    public function delete(int $id){    
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE Race SET Supprime = 1 WHERE idRace = :idRace";
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idRace', $id, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';

