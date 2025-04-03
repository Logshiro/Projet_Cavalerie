<?php
// Par Quentin Mitou

//On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';
include_once __DIR__ . '/../modele/fonction/fonction.php';

Class Cavalier{
    private $idCavalier;
    private $Numlicence;
    private $NomCavalier;
    private $PrenomCavalier;
    private $DateNaissanceCavalier;
    private $PhotoCavalier;
    private $NomResponsable;
    private $PreNomResponsable;
    private $TelResponsable;
    private $MailResponsable;
    private $PasswordResponsable;
    private $COPResponsable;
    private $Nomcommune;
    private $Assurance;
    private $RefG;
    public function __construct(string $idCavalier, string $Numlicence,string $NomCavalier,string $PrenomCavalier,string $DateNaissanceCavalier,
                                string $NomResponsable,string $PreNomResponsable,string $TelResponsable,string $MailResponsable,
                                string $PasswordResponsable,string $COPResponsable,string $Nomcommune,string $Assurance,string $RefG){
        $this -> idCavalier = $idCavalier;
        $this -> Numlicence = $Numlicence;
        $this -> NomCavalier = $NomCavalier;
        $this -> PrenomCavalier = $PrenomCavalier;
        $this -> DateNaissanceCavalier = $DateNaissanceCavalier;
        $this -> NomResponsable = $NomResponsable;
        $this -> PreNomResponsable = $PreNomResponsable;
        $this -> TelResponsable = $TelResponsable;
        $this -> MailResponsable = $MailResponsable;
        $this -> PasswordResponsable = $PasswordResponsable;
        $this -> COPResponsable = $COPResponsable;
        $this -> Nomcommune = $Nomcommune;
        $this -> Assurance = $Assurance;
        $this -> RefG = $RefG;
    }

    // Getters
    public function getidCavalier(){
        return $this -> idCavalier;
    }
    public function getNumlicence(){
        return $this -> Numlicence;
    }
    public function getNomCavalier(){
        return $this -> NomCavalier;
    }
    public function getPrenomCavalier(){
        return $this -> PrenomCavalier;
    }
    public function getDateNaissanceCavalier(){
        return $this -> DateNaissanceCavalier;
    }
    public function getNomResponsable(){
        return $this ->NomResponsable;
    }
    public function getPreNomResponsable(){
        return $this ->PreNomResponsable;
    }
    public function getTelResponsable(){
        return $this ->TelResponsable;
    }
    public function getMailResponsable(){
        return $this ->MailResponsable;
    }
    public function getPasswordResponsable(){
        return $this ->PasswordResponsable;
    }
    public function getCOPResponsable(){
        return $this ->COPResponsable;
    }
    public function getNomcommune(){
        return $this ->Nomcommune;
    }
    public function getAssurance(){
        return $this ->Assurance;
    }
    public function getRefG(){
        return $this ->RefG;
    }

    // Setters
    public function setNumlicence(string $Numlicence){
        $this -> Numlicence = $Numlicence;
    }
    public function setAnneeFab(string $NomCavalier){
        $this -> NomCavalier = $NomCavalier;
    }
    public function setPrenomCavalier(string $PrenomCavalier){
        $this -> PrenomCavalier = $PrenomCavalier;
    }
    public function setPoidsDateNaissanceCavalier(string $DateNaissanceCavalier){
        $this -> DateNaissanceCavalier = $DateNaissanceCavalier;
    }
    public function setNomResponsable(string $NomResponsable){
        $this -> NomResponsable = $NomResponsable;
    }
    public function setPreNomResponsable(string $PreNomResponsable){
        $this -> PreNomResponsable = $PreNomResponsable;
    }
    public function setTelResponsable(string $TelResponsable){
        $this -> TelResponsable = $TelResponsable;
    }
    public function setMailResponsable(string $MailResponsable){
        $this -> MailResponsable = $MailResponsable;
    }
    public function setPasswordResponsable(string $PasswordResponsable){
        $this -> PasswordResponsable = $PasswordResponsable;
    }
    public function setCOPResponsable(string $COPResponsable){
        $this -> COPResponsable = $COPResponsable;
    }
    public function setNomcommune(string $Nomcommune){
        $this -> Nomcommune = $Nomcommune;
    }
    public function setAssurance(string $Assurance){
        $this -> Assurance = $Assurance;
    }public function setRefG(string $RefG){
        $this -> RefG = $RefG;
    }

    //Fonction pour récupérer tous les enregistrements
    public function cavalier_all(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idCavalier,Numlicence,NomCavalier,PrenomCavalier,DateNaissanceCavalier
                ,NomResponsable,PreNomResponsable,TelResponsable,MailResponsable,PasswordResponsable,COPResponsable
                ,Nomcommune,Assurance,RefG,Supprime from Cavalier where Supprime = 0";
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        // recupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetchall();
        //On retourne le résultat
        return $resultat;  
    }

    //Fonction pour récupérer un enregistrement par son id
    public function cavalier_id($idCavalier){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select * from Cavalier where idCavalier = :idCavalier";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $data = [":idCavalier" => $idCavalier];
        //On exécute la requête
        $req->execute($data);
        //On récupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne le résultat
        return $resultat;
    }

    //Fonction pour récupérer le nom du cavalier
    public function getCavalierRefG($RefG) {
        $connexion = connexionPDO();// Connection PDO
        $sql = "SELECT LibGalop FROM galop WHERE idGalop = :RefG";
        //On prépare la requête
        $stmt = $connexion->prepare($sql);
        //On exécute la requête
        $data = [":RefG" => $RefG];
        //On exécute la requête
        $stmt->execute($data);
        //On récupère la ligne sous forme de tableau
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //On retourne le résultat
        return $result['LibGalop'];
    }

    //Fonction pour modifier un enregistrement
    public function edit(){
        $Con = connexionPDO(); // Connection PDO
        // Formatage de la date avant la mise à jour
        $formattedDate = getFormattedDateForDisplay($this->DateNaissanceCavalier);

        $SQL = "UPDATE cavalier SET Numlicence = :Numlicence,
                NomCavalier = :NomCavalier,
                PrenomCavalier = :PrenomCavalier,
                DateNaissanceCavalier = :DateNaissanceCavalier,
                NomResponsable = :NomResponsable,
                PreNomResponsable = :PreNomResponsable,
                TelResponsable = :TelResponsable,
                MailResponsable = :MailResponsable,
                PasswordResponsable = :PasswordResponsable,
                COPResponsable = :COPResponsable,
                Nomcommune = :Nomcommune,
                Assurance = :Assurance,
                RefG = :RefG WHERE idCavalier = :idCavalier";
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":idCavalier" =>$this->idCavalier,":Numlicence" => $this->Numlicence,":NomCavalier" => $this->NomCavalier,":PrenomCavalier" => $this->PrenomCavalier,":DateNaissanceCavalier"=> $formattedDate,
                ":NomResponsable"=> $this->NomResponsable,":PreNomResponsable"=> $this->PreNomResponsable,":TelResponsable"=> $this->TelResponsable,
                ":PasswordResponsable"=> $this->PasswordResponsable,":MailResponsable"=> $this->MailResponsable,":COPResponsable"=> $this->COPResponsable,":Nomcommune"=> $this->Nomcommune,":Assurance"=> $this->Assurance,
                ":RefG"=> $this->RefG];
        //On exécute la requête
        return $req->execute($data);
    }
    //Fonction pour ajouter un enregistrement
    public function add(){
        $Con = connexionPDO(); // Connection PDO
        // Formatage de la date avant l'insertion
        $formattedDate = getFormattedDateForDisplay($this->DateNaissanceCavalier);
        
        $SQL = "INSERT INTO 
                `cavalier` (`Numlicence`,`NomCavalier`,`PrenomCavalier`,`DateNaissanceCavalier`,`NomResponsable`,`PreNomResponsable`,`TelResponsable`,`PasswordResponsable`,`MailResponsable`,`COPResponsable`,`Nomcommune`,
                `Assurance`,`RefG`) 
                VALUES 
                (:Numlicence, :NomCavalier, :PrenomCavalier, :DateNaissanceCavalier, :NomResponsable, :PreNomResponsable,:TelResponsable
                ,:PasswordResponsable,:MailResponsable,:COPResponsable,:Nomcommune,:Assurance,:RefG)";
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":Numlicence" => $this->Numlicence,
                ":NomCavalier" => $this->NomCavalier,
                ":PrenomCavalier" => $this->PrenomCavalier,
                ":DateNaissanceCavalier"=> $formattedDate, // Utilisation de la date formatée
                ":NomResponsable"=> $this->NomResponsable,
                ":PreNomResponsable"=> $this->PreNomResponsable,
                ":TelResponsable"=> $this->TelResponsable,
                ":PasswordResponsable"=> $this->PasswordResponsable,
                ":MailResponsable"=> $this->MailResponsable,
                ":COPResponsable"=> $this->COPResponsable,
                ":Nomcommune"=> $this->Nomcommune,
                ":Assurance"=> $this->Assurance,
                ":RefG"=> $this->RefG];
        //On exécute la requête
        return $req->execute($data);
    }

    //Fonction pour supprimer un enregistrement
    public function delete($idCavalier){
        $Con = connexionPDO();
        $SQL = "UPDATE cavalier SET Supprime = 1 WHERE idCavalier = :idCavalier";
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":idCavalier"=> $idCavalier];
        
        //On exécute la requête
        return $req->execute($data);
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';

