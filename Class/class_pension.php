<?php

include_once __DIR__ . '/../PDO/bdd.inc.php';
include_once __DIR__ . '/../modele/fonction/fonction.php';
class Pension {

    private $idPension;
    private $Tarifs;
    private $LibPension;
    private $DateDebutP;
    private $DateFinP;
    private $RefNumSir;
    private $RefCavalier;
    public function __construct($idPension = null, $Tarifs = null, $LibPension = null, $DateDebutP = null, $DateFinP = null, $RefNumSir = null, $RefCavalier = null) {
        $this->idPension = $idPension;
        $this->Tarifs = $Tarifs;
        $this->LibPension = $LibPension;
        $this->DateDebutP = $DateDebutP;
        $this->DateFinP = $DateFinP;
        $this->RefNumSir = $RefNumSir;
        $this->RefCavalier = $RefCavalier;
    }

    // Getters
    public function getidPension() {
        return $this->idPension;
    }

    public function getTarifs() {
        return $this->Tarifs;
    }

    public function getLibPension() {
        return $this->LibPension;
    }

    public function getDateDebutP() {
        return $this->DateDebutP;
    }

    public function getDateFinP() {
        return $this->DateFinP;
    }

    public function getRefNumSir() {
        return $this->RefNumSir;
    }

    public function getRefCavalier() {
        return $this->RefCavalier;
    }

    // Setters
    public function setTarifs($Tarifs) {
        $this->Tarifs = $Tarifs;
    }

    public function setLibPension($LibPension) {
        $this->LibPension = $LibPension;
    }

    public function setDateDebutP($DateDebutP) {
        $this->DateDebutP = $DateDebutP;
    }

    public function setDateFinP($DateFinP) {
        $this->DateFinP = $DateFinP;
    }
    //Fonction pour récupérer tous les enregistrements
    public function pension_all() {
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT idPension, Tarifs, LibPension, DateDebutP, DateFinP, RefNumSir, RefCavalier, Supprime FROM pension WHERE Supprime = 0";
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        // recupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchAll();
        //On retourne le résultat
        return $resultat;
    }

    public function getLastInsertId() {
        return $this->idPension;
    }

    public function getpensionCavalier($RefCavalier) {
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT NomCavalier FROM cavalier WHERE idCavalier = :RefCavalier";
        $req = $Con->prepare($SQL);
        $data = [":RefCavalier" => $RefCavalier];
        $req->execute($data);
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        return $resultat['NomCavalier'];
    }

    //Fonction pour récupérer un enregistrement par son id
    public function pension_id($id) {
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT * FROM pension WHERE idPension = :idPension";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $data = [":idPension" => $id];
        //On exécute la requête
        $req->execute($data);
        //On récupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne le résultat
        return $resultat;
    }

    //Fonction pour récupérer le nom du cheval
    public function getPensionCavalerie($id) {
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT NomCheval FROM cavalerie WHERE NumSir = :NumSir";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $data = [":NumSir" => $id];
        //On exécute la requête
        $req->execute($data);
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne la valeur de la colonne NomCheval
        return $ligne["NomCheval"];
    }

    //Fonction pour modifier un enregistrement
    public function edit() {
        //Formatage de la date avant la mise à jour
        $formattedDateDebutP = getFormattedDateForDisplay($this->DateDebutP);
        $formattedDateFinP = getFormattedDateForDisplay($this->DateFinP);
        $con = connexionPDO();// Connection PDO
        $sql = "UPDATE pension SET Tarifs = :Tarifs, LibPension = :LibPension, DateDebutP = :DateDebutP, DateFinP = 
        :DateFinP, RefNumSir = :RefNumSir, RefCavalier = :RefCavalier WHERE idPension = :idPension";
        //On lie les paramètres
        $req = $con->prepare($sql);
        //On lie les paramètres
        $data = [
            ':idPension' => $this->idPension,
            ':Tarifs' => $this->Tarifs,
            ':LibPension' => $this->LibPension,
            ':DateDebutP' => $formattedDateDebutP,
            ':DateFinP' => $formattedDateFinP,
            ':RefNumSir' => $this->RefNumSir,
            ':RefCavalier' => $this->RefCavalier
        ];

        //On exécute la requête
        return $req->execute($data);
    }

    //Fonction pour ajouter un enregistrement
    public function add() {
        //Formatage de la date avant l'insertion
        $formattedDateDebutP = getFormattedDateForDisplay($this->DateDebutP);
        $formattedDateFinP = getFormattedDateForDisplay($this->DateFinP);
        $con = connexionPDO();// Connection PDO
        $sql = "INSERT INTO pension (Tarifs, LibPension, DateDebutP, DateFinP, RefNumSir, RefCavalier) 
                VALUES (:Tarifs, :LibPension, :DateDebutP, :DateFinP, :RefNumSir, :RefCavalier)";
        //On lie les paramètres
        $req = $con->prepare($sql);
        //On lie les paramètres
        $data = [
            ':Tarifs' => $this->Tarifs,
            ':LibPension' => $this->LibPension,
            ':DateDebutP' => $formattedDateDebutP,
            ':DateFinP' => $formattedDateFinP,
            ':RefNumSir' => $this->RefNumSir,
            ':RefCavalier' => $this->RefCavalier
        ];
        //On exécute la requête
        $success = $req->execute($data);
        if ($success) {
            $this->idPension = $con->lastInsertId();
            return true;
        }
        return false;
    }

    //Fonction pour supprimer un enregistrement
    public function delete($id){
        $con = connexionPDO();// Connection PDO
        $sql = "UPDATE pension SET Supprime = 1 WHERE idPension = :idPension;";
        //On prépare la requête
        $req = $con->prepare($sql);
        //On lie les paramètres
        $req->bindParam(':idPension', $id, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';

