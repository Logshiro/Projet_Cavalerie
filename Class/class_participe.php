<?php
// Par Quentin Mitou

// On importe la connexion PDO
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Participe
{
    private $refcavalier;
    private $refcours;
    private $refSeance;
    private $present;

    public function __construct($refseance, $refcours, $refcavalier, $present)
    {
        $this->refSeance = $refseance;
        $this->refcours = $refcours;
        $this->refcavalier = $refcavalier;
        $this->present = $present;
    }

    // Getters
    public function getrefcavalier()
    {
        return $this->refcavalier;
    }

    public function getRefcours()
    {
        return $this->refcours;
    }
    public function getRefSeance()
    {
        return $this->refSeance;
    }
    public function getPresent()
    {
        return $this->present;
    }

    public function Participe_all(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select idCourSeance,idCoursCours,RefCavalier,present from participe where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function Participe_id($refSeance , $refcours, $refcavalier){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select idCourSeance,idCoursCours,RefCavalier,present from participe where
        RefCavalier = :RefCavalier AND idCoursCours = :RefCours AND idCourSeance = :RefSeance";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $refcours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $refcavalier, PDO::PARAM_INT);
        $req->bindParam(':RefSeance', $refSeance, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function Participe_idCC($refcours, $refcavalier){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select idCourSeance,idCoursCours,RefCavalier,present from participe where
        RefCavalier = :RefCavalier AND idCoursCours = :RefCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $refcours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $refcavalier, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetchall(PDO::FETCH_ASSOC);
    }

    public function getCavalierParticipe($refcavalier){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "SELECT NomCavalier FROM cavalier WHERE idCavalier = :RefCavalier";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCavalier', $refcavalier, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne la valeur de la colonne NomCavalier
        return $ligne["NomCavalier"];
    }

    public function getInscritParticipe($RefCavalier,$refcours){
            $Con = connexionPDO(); // Connexion PDO
            $SQL = "Select RefCavalier,RefCours from inscrit where Supprime = 0";
            //On prépare la requête
            $req = $Con->prepare($SQL);
            $req->bindParam("RefCours", $refcours, PDO::PARAM_INT);
            $req->bindParam("RefCavalier", $RefCavalier, PDO::PARAM_INT);
            //On exécute la requête
            $req->execute();
            //On récupère tous les enregistrements sous forme de tableau
            $resultat = $req->fetchall(PDO::FETCH_ASSOC);
            return $resultat;
        }

    public function getCalendrierParticipe($idCoursCours){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select idCourSeance from calendrier where idCoursCours = :idCoursCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(":idCoursCours", $idCoursCours, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }

    public function add($idSeance,$idCours,$cleanRefCavalier){
        $Con = connexionPDO(); // Connexion PDO idCourSeance,idCoursCours,RefCavalier
        if ($this->Participe_idCC($idCours, $cleanRefCavalier) == null){
        // Ensure idSeance is a single integer value
        if (is_array($idSeance)) {
            throw new Exception("idCourSeance should be a single integer value, not an array.");
        }

        // Check if idCourSeance exists in calendrier table
        $SQLCheck = "SELECT 1 FROM calendrier WHERE idCourSeance = :idCourSeance";
        $reqCheck = $Con->prepare($SQLCheck);
        $reqCheck->bindParam(':idCourSeance', $idSeance, PDO::PARAM_INT);
        $reqCheck->execute();
        $exists = $reqCheck->fetchColumn();

        if (!$exists) {
            throw new Exception("idCourSeance $idSeance does not exist in calendrier table.");
        }

        $SQL = "Insert into participe (idCourSeance, idCoursCours, RefCavalier, present)
        values (:idCourSeance, :idCoursCours, :RefCavalier, :present)";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idCourSeance', $idSeance, PDO::PARAM_INT);
        $req->bindParam(':idCoursCours', $idCours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $cleanRefCavalier, PDO::PARAM_INT);
        $req->bindParam(':present', $this->present, PDO::PARAM_BOOL);

        // Debug statements
        echo "Inserting into participe: idCourSeance=$idSeance, idCoursCours=$idCours, RefCavalier=$cleanRefCavalier, present=" . ($this->present ? 'true' : 'false') . "<br>";

        //On exécute la requête
        return $req->execute();

    }else{
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update participe set Supprime = 0 where RefCavalier = :RefCavalier and idCoursCours = :idCoursCours and Supprime = 1";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idCoursCours', $idCours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $cleanRefCavalier, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }
    }

    public function edit($id1, $id2, $id3) {
        $Con = connexionPDO(); // Connexion PDO
        if ($this->Participe_idCC($id2, $id3) == null){
        $SQL = "Update participe set idCourSeance = :idCourSeance, idCoursCours = :idCoursCours
        RefCavalier = :RefCavalier where idCourSeance = :id1 and idCoursCours = :id2 and
        RefCavalier = :id3";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idCourSeance', $this->refSeance, PDO::PARAM_INT);
        $req->bindParam(':idCoursCours', $this->refcours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $this->refcavalier, PDO::PARAM_INT);
        $req->bindParam(':id1', $id1, PDO::PARAM_INT);
        $req->bindParam(':id2', $id2, PDO::PARAM_INT);
        $req->bindParam(':id3', $id3, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();

    }else{
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update participe set Supprime = 0 where RefCavalier = :RefCavalier and idCoursCours = :idCoursCours and Supprime = 1";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idCoursCours', $id2, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $id3, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }
    }

    public function delete() {
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update participe set Supprime = 1 where idCourSeance = :idCourSeance and idCoursCours =
        :idCoursCours and RefCavalier = :RefCavalier";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idCourSeance', $this->$refseance, PDO::PARAM_INT);
        $req->bindParam(':idCoursCours', $this->refcours, PDO::PARAM_INT);
        $req->bindParam('RefCavalier', $this->refcavalier,PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    public function delete_idCava() {
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update participe set Supprime = 1 where idCoursCours =
        :idCoursCours and RefCavalier = :RefCavalier";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':idCoursCours', $this->refcours, PDO::PARAM_INT);
        $req->bindParam('RefCavalier', $this->refcavalier,PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    public function delete_idCours($id){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update participe set Supprime = 1 where RefCours = :RefCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $id, PDO::PARAM_INT);
        return $req->execute();
    }

}