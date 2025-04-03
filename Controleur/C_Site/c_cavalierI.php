<?php
// Par Quentin Mitou

require_once "$racine/Class/class_cavalier.php"; // Inclusion de la connexion PDO

$valide = false;
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['numLicence']) && !empty($_POST['numLicence']) 
        && isset($_POST['nomCavalier']) && !empty($_POST['nomCavalier']) 
        && isset($_POST['prenomCavalier']) && !empty($_POST['prenomCavalier']) 
        && isset($_POST['dateNaissanceCavalier']) && !empty($_POST['dateNaissanceCavalier'])
        && isset($_POST['nomResponsable']) && !empty($_POST['nomResponsable'])
        && isset($_POST['prenomResponsable']) && !empty($_POST['prenomResponsable'])
        && isset($_POST['telResponsable']) && !empty($_POST['telResponsable'])
        && isset($_POST['mail']) && !empty($_POST['mail'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['passwordResponsable']) && !empty($_POST['passwordResponsable'])
        && isset($_POST['COPResponsable']) && !empty($_POST['COPResponsable'])
        && isset($_POST['nomCommune']) && !empty($_POST['nomCommune'])
        && isset($_POST['assurance']) && !empty($_POST['assurance'])
        && isset($_POST['idGalop']) && !empty($_POST['idGalop'])
        ){

        //On nettoie les données
        $NumLicence = strip_tags($_POST['numLicence']);
        $NomCavalier = strip_tags($_POST['nomCavalier']);
        $PrenomCavalier = strip_tags($_POST['prenomCavalier']);
        $DateNaissanceCavalier = strip_tags($_POST['dateNaissanceCavalier']);
        $NomResponsable = strip_tags($_POST['nomResponsable']); 
        $PreNomResponsable = strip_tags($_POST['prenomResponsable']);
        $TelResponsable = strip_tags($_POST['telResponsable']);
        $MailResponsable = strip_tags($_POST['mail']);
        $PasswordResponsable = strip_tags($_POST['passwordResponsable']);
        $Password = strip_tags($_POST['password']);
        $COPResponsable = strip_tags($_POST['COPResponsable']);
        $Nomcommune = strip_tags($_POST['nomCommune']);
        $Assurance = strip_tags($_POST['assurance']);
        $idGalop = strip_tags($_POST['idGalop']);
        //On crée un nouvel objet Cavalier
        $Cavalier = new Cavalier("", $NumLicence, $NomCavalier, $PrenomCavalier, 
        $DateNaissanceCavalier, $NomResponsable, $PreNomResponsable, $TelResponsable, 
        $MailResponsable, $PasswordResponsable, $COPResponsable, $Nomcommune, $Assurance, $idGalop);

        //verifie si les mots de passe sont identiques
        if ($Password == $PasswordResponsable){
            //On ajoute le produit
            $MPro = $Cavalier->add();
        }else{
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Les mots de passe ne correspondent pas";
            //On redirige vers la page de la cavalier
            require_once "$racine/Vue/Vue_Site/inscription.php";
            die();
        }

        //On affiche un message de succès
        $_SESSION['message'] = "Cavalier ajouté avec succès";
        //On redirige vers la page de la cavalier
    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la cavalier
        require_once "$racine/Vue/Vue_Site/inscription.php";
        die();  
    }
}