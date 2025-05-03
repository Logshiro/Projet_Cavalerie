<?php
// Par Quentin Mitou

// On importe la connexion PDO
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Inscrit
{
    private $refcavalier;
    private $refcours;

    public function __construct($refcavalier, $refcours)
    {
        $this->refcavalier = $refcavalier;
        $this->refcours = $refcours;
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

    // Méthode pour récupérer tous les inscrits
    public function inscrit_all(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select RefCavalier,RefCours from inscrit where Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    // Méthode pour récupérer un inscrit par son id
    public function inscrit_id($refcavalier, $refcours){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select RefCavalier,RefCours from inscrit where RefCavalier = :RefCavalier AND RefCours = :RefCours and Supprime = 0";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $refcours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $refcavalier, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer un inscrit par son id
    public function inscrit_id_sup($refcavalier, $refcours){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select RefCavalier,RefCours from inscrit where RefCavalier = :RefCavalier AND RefCours = :RefCours and Supprime = 1";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $refcours, PDO::PARAM_INT);
        $req->bindParam(':RefCavalier', $refcavalier, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer le nom du cavalier
    public function getCavalierInscrit($refcavalier){
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

    // Méthode pour récupérer le nom du cours
    public function getCoursInscrit($refcours){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "SELECT Libcours FROM cours WHERE idCours = :RefCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $refcours, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        return $ligne["Libcours"];
    }

    // Méthode pour ajouter un inscrit
    public function add(){
        if ($this->inscrit_id_sup($this->refcavalier, $this->refcours) == null){
            $Con = connexionPDO(); // Connexion PDO
            $SQL = "Insert into inscrit (RefCavalier, RefCours) values (:RefCavalier, :RefCours)";
            //On prépare la requête
            $req = $Con->prepare($SQL);
            //On lie les paramètres
            $req->bindParam(':RefCavalier', $this->refcavalier, PDO::PARAM_INT);
            $req->bindParam(':RefCours', $this->refcours, PDO::PARAM_INT);
            //On exécute la requête
            return $req->execute();
        }else{
            $Con = connexionPDO(); // Connexion PDO
            $SQL = "Update inscrit set Supprime = 0 where RefCavalier = :RefCavalier and RefCours = :RefCours";
            //On prépare la requête
            $req = $Con->prepare($SQL);
            //On lie les paramètres
            $req->bindParam(':RefCours', $this->refcours, PDO::PARAM_INT);
            $req->bindParam(':RefCavalier', $this->refcavalier, PDO::PARAM_INT);
            //On exécute la requête
            return $req->execute();
        }
    }



    // Méthode pour modifier un inscrit
    public function edit($id1, $id2) {
        if ($this->inscrit_id_sup($this->refcavalier, $this->refcours) == null){
            $Con = connexionPDO(); // Connexion PDO
            $SQL = "Update inscrit set RefCours = :RefCours, RefCavalier = :RefCavalier where RefCavalier = :id1 and RefCours = :id2";
            //On prépare la requête
            $req = $Con->prepare($SQL);
            //On lie les paramètres
            $req->bindParam(':RefCours', $this->refcours, PDO::PARAM_INT);
            $req->bindParam(':RefCavalier', $this->refcavalier, PDO::PARAM_INT);
            $req->bindParam(':id1', $id1, PDO::PARAM_INT);
            $req->bindParam(':id2', $id2, PDO::PARAM_INT);
            //On exécute la requête
            return $req->execute();
        }else{
            $Con = connexionPDO(); // Connexion PDO
            $SQL = "Update inscrit set Supprime = 0 where RefCavalier = :RefCavalier and RefCours = :RefCours";
            //On prépare la requête
            $req = $Con->prepare($SQL);
            //On lie les paramètres
            $req->bindParam(':RefCours', $this->refcours, PDO::PARAM_INT);
            $req->bindParam(':RefCavalier', $this->refcavalier, PDO::PARAM_INT);
            //On exécute la requête
            return $req->execute();
        }
    }

    // Méthode pour supprimer un inscrit
    public function delete(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update inscrit set Supprime = 1 where RefCavalier = :RefCavalier and RefCours = :RefCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCavalier', $this->refcavalier, PDO::PARAM_INT);
        $req->bindParam(':RefCours', $this->refcours, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    public function delete_idCours($id){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update inscrit set Supprime = 1 where RefCours = :RefCours";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':RefCours', $id, PDO::PARAM_INT);
        return $req->execute();
    }


}
