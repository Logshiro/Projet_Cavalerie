<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['Numlicence']) && !empty($_POST['Numlicence']) 
        && isset($_POST['NomCavalier']) && !empty($_POST['NomCavalier']) 
        && isset($_POST['PrenomCavalier']) && !empty($_POST['PrenomCavalier']) 
        && isset($_POST['DateNaissanceCavalier']) && !empty($_POST['DateNaissanceCavalier'])
        && isset($_POST['NomResponsable']) && !empty($_POST['NomResponsable'])
        && isset($_POST['PreNomResponsable']) && !empty($_POST['PreNomResponsable'])
        && isset($_POST['TelResponsable']) && !empty($_POST['TelResponsable'])
        && isset($_POST['MailResponsable']) && !empty($_POST['MailResponsable'])
        && isset($_POST['PasswordResponsable']) && !empty($_POST['PasswordResponsable'])
        && isset($_POST['COPResponsable']) && !empty($_POST['COPResponsable'])
        && isset($_POST['Nomcommune']) && !empty($_POST['Nomcommune'])
        && isset($_POST['Assurance']) && !empty($_POST['Assurance'])
        && isset($_POST['idGalop']) && !empty($_POST['idGalop'])
        ){

        //On nettoie les données
        $Numlicence = strip_tags($_POST['Numlicence']);
        $NomCavalier = strip_tags($_POST['NomCavalier']);
        $PrenomCavalier = strip_tags($_POST['PrenomCavalier']);
        $DateNaissanceCavalier = strip_tags($_POST['DateNaissanceCavalier']);
        $NomResponsable = strip_tags($_POST['NomResponsable']); 
        $PreNomResponsable = strip_tags($_POST['PreNomResponsable']);
        $TelResponsable = strip_tags($_POST['TelResponsable']);
        $MailResponsable = strip_tags($_POST['MailResponsable']);
        $PasswordResponsable = strip_tags($_POST['PasswordResponsable']);
        $COPResponsable = strip_tags($_POST['COPResponsable']);
        $Nomcommune = strip_tags($_POST['Nomcommune']);
        $Assurance = strip_tags($_POST['Assurance']);
        $idGalop = strip_tags($_POST['idGalop']);
        //On crée un nouvel objet Cavalier
        $Cavalier = new Cavalier("", $Numlicence, $NomCavalier, $PrenomCavalier, 
        $DateNaissanceCavalier, $NomResponsable, $PreNomResponsable, $TelResponsable, 
        $MailResponsable, $PasswordResponsable, $COPResponsable, $Nomcommune, $Assurance, $idGalop);

        //On ajoute le produit
        $MPro = $Cavalier->add();

        //On affiche un message de succès
        $_SESSION['message'] = "Cavalier ajouté avec succès";
        //On redirige vers la page de la cavalier
        header('Location: vue_cavalier.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la cavalier
        header('Location: vue_cavalier.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cavalier</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_cavalier.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Cavalier</h1>
                <!-- On crée un formulaire pour ajouter un cavalier -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le cavalier -->
                        <label for="Numlicence">Numéro de licence :</label>
                        <!-- On crée un champ pour le cavalier -->
                        <input type="text" name="Numlicence" id="Numlicence" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le cavalier -->
                        <label for="NomCavalier">Nom Cavalier :</label>
                        <!-- On crée un champ pour le cavalier -->
                        <input type="text" name="NomCavalier" id="NomCavalier" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="PrenomCavalier">Prenom Cavalier :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="PrenomCavalier" id="PrenomCavalier" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la date de naissance -->
                        <label for="DateNaissanceCavalier">Date de naissance :</label>
                        <!-- On crée un champ pour la date de naissance -->
                        <input type="date" name="DateNaissanceCavalier" id="DateNaissanceCavalier" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nom du responsable -->
                        <label for="NomResponsable">Nom du responsable :</label>
                        <!-- On crée un champ pour le nom du responsable -->
                        <input type="text" name="NomResponsable" id="NomResponsable" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le prénom du responsable -->
                        <label for="PreNomResponsable">Prénom du responsable :</label>
                        <!-- On crée un champ pour le prénom du responsable -->
                        <input type="text" name="PreNomResponsable" id="PreNomResponsable" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le téléphone du responsable -->
                        <label for="TelResponsable">Téléphone du responsable :</label>
                        <!-- On crée un champ pour le téléphone du responsable -->
                        <input type="tel" name="TelResponsable" id="TelResponsable" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le mail du responsable -->
                        <label for="MailResponsable">Mail du responsable :</label>
                        <!-- On crée un champ pour le mail du responsable -->
                        <input type="email" name="MailResponsable" id="MailResponsable" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le mot de passe du responsable -->
                        <label for="PasswordResponsable">Mot de passe du responsable :</label>
                        <!-- On crée un champ pour le mot de passe du responsable -->
                        <input type="password" name="PasswordResponsable" id="PasswordResponsable" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le COP du responsable -->
                        <label for="COPResponsable">COP du responsable :</label>
                        <!-- On crée un champ pour le COP du responsable -->
                        <input type="text" name="COPResponsable" id="COPResponsable" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nom de la commune -->
                        <label for="Nomcommune">Nom de la commune :</label>
                        <!-- On crée un champ pour le nom de la commune -->
                        <input type="text" name="Nomcommune" id="Nomcommune" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour l'assurance -->
                        <label for="Assurance">Assurance :</label>
                        <!-- On crée un champ pour l'assurance -->
                        <input type="text" name="Assurance" id="Assurance" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la référence G -->
                        <label for="RefG">Référence G :</label>
                        <!-- On crée un champ pour la référence G -->
                        <input type="text" name="RefG" id="RefG" onkeyup="autocompletRefG_Insert()" class="form-control" required>
                        <div id="nom_list_idRefG" class="list-group"></div>
                        <input type="hidden" name="idGalop" id="idGalop">
                    </div>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
