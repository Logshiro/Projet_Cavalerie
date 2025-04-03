<?php
// Par Quentin Mitou

//On charge le fichier de connexion à la base de données
require_once __DIR__ . '/../PDO/bdd.inc.php';

//On crée la classe Liste
class Liste {

        private $id;
        private $produit;
        private $prix;
        private $nombre;
    
        public function __construct($id, $produit, $prix, $nombre)
        {
            $this->id = $id;
            $this->produit = $produit;
            $this->prix = $prix;
            $this->nombre = $nombre;
        }
    
        // Getters
        public function getid()
        {
            return $this->id;
        }
    
        public function getproduit()
        {
            return $this->produit;
        }
    
        public function getprix()
        {
            return $this->prix;
        }
    
        public function getnombre()
        {
            return $this->nombre;
        }
    
    
        // Setters
    
        public function setproduit($produit)
        {
            $this->produit = $produit;
        }
    
        public function setprix($prix)
        {
            $this->prix = $prix;
        }
    
        public function setnombre($nombre)
        {
            $this->nombre = $nombre;
        }

    //Fonction pour récupérer touts les produits
    public function liste_all(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select id,produit,prix,nombre from liste";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On exécute la requête
        $req->execute();
        //On récupère tous les enregistrements sous forme de tableau
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);
        return $resultat;
    }

    //Fonction pour récupérer un produit par son id
    public function liste_one($id){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Select id,produit,prix,nombre from liste where id = :id";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        //On exécute la requête
        $req->execute();
        //On récupère le 1° enregistrement sous forme de tableau
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //Fonction pour ajouter un produit
    public function add(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Insert into liste (produit, prix, nombre) values (:produit, :prix, :nombre)";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':produit', $this->produit, PDO::PARAM_STR);
        $req->bindParam(':prix', $this->prix, PDO::PARAM_INT);
        $req->bindParam(':nombre', $this->nombre, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour modifier un produit
    public function edit(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Update liste set produit = :produit, prix = :prix, nombre = :nombre where id = :id";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':id', $this->id, PDO::PARAM_INT);
        $req->bindParam(':produit', $this->produit, PDO::PARAM_STR);
        $req->bindParam(':prix', $this->prix, PDO::PARAM_INT);
        $req->bindParam(':nombre', $this->nombre, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }

    //Fonction pour supprimer un produit
    public function delete(){
        $Con = connexionPDO(); // Connexion PDO
        $SQL = "Delete from liste where id = :id";
        //On prépare la requête
        $req = $Con->prepare($SQL);
        //On lie les paramètres
        $req->bindParam(':id', $this->id, PDO::PARAM_INT);
        //On exécute la requête
        return $req->execute();
    }           
}

//Fermeture de la connexion PDO
require_once '../PDO/close.inc.php';
