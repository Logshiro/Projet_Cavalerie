<?php
//On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';

class Cours
{
    private $idcours;
    private $libcours;
    private $jourC;
    private $horaireD;
    private $horaireF;
    private $idGalop;
    public function __construct($idcours, $libcours, $jourC, $horaireD, $horaireF, $idGalop)
    {
        $this->idcours = $idcours;
        $this->libcours = $libcours;
        $this->jourC = $jourC;
        $this->horaireD = $horaireD;
        $this->horaireF = $horaireF;
        $this->idGalop = $idGalop;
    }

    // Getters
    public function getIdcours()
    {
        return $this->idcours;
    }

    public function getLibcours()
    {
        return $this->libcours;
    }

    public function getJourC()
    {
        return $this->jourC;
    }

    public function getHoraireD()
    {
        return $this->horaireD;
    }

    public function getHoraireF()
    {
        return $this->horaireF;
    }

    public function getIdGalop()
    {
        return $this->idGalop;
    }

    // Setters

    public function setLibcours($libcours)
    {
        $this->libcours = $libcours;
    }

    public function setJourC($jourC)
    {
        $this->jourC = $jourC;
    }

    public function setHoraireD($horaireD)
    {
        $this->horaireD = $horaireD;
    }

    public function setHoraireF($horaireF)
    {
        $this->horaireF = $horaireF;
    }

    public function setIdGalop($idGalop)
    {
        $this->idGalop = $idGalop;
    }

    public function Cours_All(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idCours,Libcours,jour,HD,HF,RefGalop from cours where Supprime = 0";
        $req = $Con->prepare($SQL);
        $req->execute();
        // recupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetchall();
        return $resultat;  
    }

    public function coursMax() {
        $Con = connexionPDO();
        try {
            $SQL = "SELECT COALESCE(MAX(idCours), 0) as maxId FROM cours";
            $req = $Con->prepare($SQL);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
            return $resultat['maxId'];
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du max idCours: " . $e->getMessage());
            return 0;
        }
    }

    // public function SeanceMax() {
    //     $Con = connexionPDO();
    //     try {
    //         $SQL = "SELECT COALESCE(MAX(idCourSeance), 0) as maxId FROM calendrier";
    //         $req = $Con->prepare($SQL);
    //         $req->execute();
    //         $resultat = $req->fetch(PDO::FETCH_ASSOC);
    //         return $resultat['maxId'];
    //     } catch (PDOException $e) {
    //         error_log("Erreur lors de la récupération du max idSeance: " . $e->getMessage());
    //         return 0;
    //     }
    // }

    public function Cours_id($idCours){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "Select idCours,Libcours,jour,HD,HF,RefGalop,Supprime from cours where idCours = :idCours and Supprime = 0";
        // Prépare la requête
        $req = $Con->prepare($SQL);
        // Exécute la requête avec le paramètre idCours
        $req->execute([":idCours" => $idCours]);
        // Récupère le 1° enregistrement sous forme de tableau
        $resultat = $req->fetch();
        return $resultat;
    }

    public function getCours_Cavalier($RefCavalier){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "SELECT NomCavalier FROM cavalier WHERE idCavalier = :RefCavalier";
        $req = $Con->prepare($SQL);
        $data = [":RefCavalier" => $RefCavalier];
        $req->execute($data);
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        return $resultat['NomCavalier'];
    }

    public function getCours_CavalierP($idCours) {
        $Con = connexionPDO();
        $SQL = 'SELECT RefCavalier FROM `inscrit` WHERE RefCours  = :idCours';
        $req = $Con->prepare($SQL);
        $data = ['idCours' => $idCours];
        $req->execute($data);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function getCours_Galop($RefGalop){
        $Con = connexionPDO();
        $SQL = "select LibGalop from galop where idGalop = :RefGalop";
        $req = $Con->prepare($SQL);
        $req->execute([":RefGalop" => $RefGalop]);
        $resultat = $req->fetch();
        return $resultat['LibGalop'];
    }

    public function edit(){
        $Con = connexionPDO(); // Connection PDO
        $SQL = "UPDATE cours SET Libcours = :Libcours, jour = :jour, HD = :HD, HF = :HF, RefGalop = :idGalop
                    WHERE idCours = :idCours";
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":idCours" =>$this->idcours,":Libcours" => $this->libcours, 
        ":jour" => $this->jourC,":HD" => $this->horaireD, ":HF" => $this->horaireF, ":idGalop" => $this->idGalop];

        $req->execute($data);
    
    }
    public function add(){
        $Con = connexionPDO(); // Connection PDO
        try {
            $SQL = "INSERT INTO 
                    `cours` (`Libcours`,`jour`,`HD`,`HF`,`RefGalop`) 
                    VALUES 
                    (:Libcours, :jour, :HD, :HF, :idGalop)";
            //Prépare la requête
            $req = $Con->prepare($SQL);

            //variables php -> sql
            $data = [":Libcours" => $this->libcours, ":jour" => $this->jourC,":HD" => $this->horaireD, 
            ":HF" => $this->horaireF, ":idGalop" => $this->idGalop];
            
            return $req->execute($data);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout du cours: " . $e->getMessage());
            return false;
        }
    }
    public function getCoursAssADD($idCours, $Rep){
        $Con = connexionPDO();
        
        // Tableau associatif des jours de la semaine
        $joursSemaine = [
            'lundi' => 1,
            'mardi' => 2,
            'mercredi' => 3,
            'jeudi' => 4,
            'vendredi' => 5,
            'samedi' => 6,
            'dimanche' => 7
        ];
        
        // Récupère le numéro du jour à partir du jour stocké
        $numJour = $joursSemaine[strtolower($this->jourC)];
        
        // Date du jour
        $dateDebut = new DateTime();
        
        // Prépare la requête d'insertion
        $SQL1 = "INSERT INTO calendrier (idCoursCours, DateCours) VALUES (:idCours, :dateCours)";
        $req = $Con->prepare($SQL1);
        
        $compteur = 0;
        $idSeances = []; // Tableau pour stocker les idCourSeance
        // Continue jusqu'à avoir inséré 52 cours
        while ($compteur < $Rep) {
            // Si le jour correspond au jour du cours
            if ($dateDebut->format('N') == $numJour) {
                if ($req->execute([
                    ':dateCours' => $dateDebut->format('Y-m-d'),
                    ':idCours' => $idCours
                ])) {
                    $idSeances[] = $Con->lastInsertId(); // Récupère l'id de la dernière insertion
                    // Debugging: Print the inserted ID
                    echo "Inserted ID: " . $Con->lastInsertId() . "\n"; // Check the inserted ID
                    $compteur++;
                } else {
                    // Gestion des erreurs d'insertion
                    error_log("Erreur lors de l'insertion dans calendrier: " . implode(", ", $req->errorInfo()));
                }
            }
            // Passe au jour suivant
            $dateDebut->modify('+1 day');
        }
        
        return $idSeances; // Retourne les idCourSeance créés
    }

    public function getallCavalier($RefCours){
        $Con = connexionPDO();
        $SQL = "SELECT RefCavalier FROM inscrit 
        where RefCours = :RefCours";
        $req = $Con->prepare($SQL);
        $req->execute([":RefCours" => $RefCours]);
        $resultat = $req->fetchall();
        return $resultat; // 10 participent
    }

    public function getallSeanceCours($RefCours){
        $Con = connexionPDO();
        $SQL = "SELECT idCourSeance FROM calendrier 
        where idCoursCours = :RefCours";
        $req = $Con->prepare($SQL);
        $req->execute([":RefCours"=> $RefCours]);
        $resultat = $req->fetchAll();
        return $resultat; //52 resultat de séance min
    }


    public function getCoursParticipe($idCourSeance,$idCours,$RefCavalier){
        $Con = connexionPDO();
        $SQL = "INSERT INTO participe (idCoursSeance, idCours, RefCavalier) 
                VALUES (:idCourSeance, :idCours, :RefCavalier)";
        $req = $Con->prepare($SQL);
        $req->execute([
            ":idCourSeance" => $idCourSeance, 
            ":idCours" => $idCours, 
            ":RefCavalier" => $RefCavalier
        ]);
        return true;
    }


    public function delete($idCours){
        $Con = connexionPDO();
        $SQL = "UPDATE cours SET Supprime = 1 WHERE idCours = :idCours";
        $req = $Con->prepare($SQL);
    
        //variables php -> sql
        $data = [":idCours"=> $idCours];
        
        $req->execute($data);
    }

    public function getCoursAssDelete($idCours){
        $Con = connexionPDO();
        $SQL = "DELETE FROM calendrier WHERE idCoursCours = :idCours";
        //Prépare la requête
        $req = $Con->prepare($SQL);
        //variables php -> sql
        $data = [":idCours" => $idCours];
        $req->execute($data);
    }

    public function checkSeanceExists($idCoursCours) {
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "SELECT COUNT(*) FROM calendrier WHERE idCoursCours = :idCoursCours";
        $req = $Con->prepare($SQL);
        $req->bindParam(':idCoursCours', $idCoursCours, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn() > 0; // Returns true if exists
    }
}

//Fermeture de la connexion PDO
require_once __DIR__ . '/../PDO/close.inc.php';
