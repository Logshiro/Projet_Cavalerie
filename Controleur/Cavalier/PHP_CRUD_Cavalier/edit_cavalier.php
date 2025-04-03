<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST['Numlicence']) && !empty($_POST['Numlicence'])
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
        && isset($_POST['RefG']) && !empty($_POST['RefG'])){

        //On nettoie les données
        $id = strip_tags($_POST['id']);
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
        $cavalier = new Cavalier($id, $Numlicence, $NomCavalier, $PrenomCavalier, 
        $DateNaissanceCavalier, $NomResponsable, $PreNomResponsable, 
        $TelResponsable, $MailResponsable, $PasswordResponsable, $COPResponsable, $Nomcommune, $Assurance, $idGalop);
        
        //afficher le produit
        $oneCavalier = $cavalier->edit();

        //On affiche un message de succès
        $_SESSION['message'] = "Produit modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_cavalier.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_cavalier.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet cavalier
        $C_cavalier = new Cavalier($id,"","","","","","","","","","","","","");
        //On récupère le produit par son id
        $oneCavalier = $C_cavalier->cavalier_id($id);

        //le produit n'existe pas
        if(!$oneCavalier){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_cavalier.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
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
    <title>Ajouter un Produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier le Cavalier</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le produit -->
                        <label for="Numlicence">Numlicence :</label>
                        <!-- On crée un champ pour le produit -->
                        <input type="text" name="Numlicence" id="Numlicence" class="form-control" value="<?php echo $oneCavalier['Numlicence']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="NomCavalier">NomCavalier :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="NomCavalier" id="NomCavalier" class="form-control" value="<?php echo $oneCavalier['NomCavalier']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="PrenomCavalier">PrenomCavalier :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="text" name="PrenomCavalier" id="PrenomCavalier" class="form-control" value="<?php echo $oneCavalier['PrenomCavalier']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="DateNaissanceCavalier">DateNaissanceCavalier :</label>
                        <input type="date" name="DateNaissanceCavalier" id="DateNaissanceCavalier" class="form-control" value="<?php echo $oneCavalier['DateNaissanceCavalier']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="NomResponsable">NomResponsable :</label>
                        <input type="text" name="NomResponsable" id="NomResponsable" class="form-control" value="<?php echo $oneCavalier['NomResponsable']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="PreNomResponsable">PreNomResponsable :</label>
                        <input type="text" name="PreNomResponsable" id="PreNomResponsable" class="form-control" value="<?php echo $oneCavalier['PreNomResponsable']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="TelResponsable">TelResponsable :</label>
                        <input type="text" name="TelResponsable" id="TelResponsable" class="form-control" value="<?php echo $oneCavalier['TelResponsable']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="MailResponsable">MailResponsable :</label>
                        <input type="email" name="MailResponsable" id="MailResponsable" class="form-control" value="<?php echo $oneCavalier['MailResponsable']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="PasswordResponsable">PasswordResponsable :</label>
                        <input type="password" name="PasswordResponsable" id="PasswordResponsable" class="form-control" value="<?php echo $oneCavalier['PasswordResponsable']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="COPResponsable">COPResponsable :</label>
                        <input type="text" name="COPResponsable" id="COPResponsable" class="form-control" value="<?php echo $oneCavalier['COPResponsable']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Nomcommune">Nomcommune :</label>
                        <input type="text" name="Nomcommune" id="Nomcommune" class="form-control" value="<?php echo $oneCavalier['Nomcommune']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Assurance">Assurance :</label>
                        <input type="text" name="Assurance" id="Assurance" class="form-control" value="<?php echo $oneCavalier['Assurance']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="RefG">RefG :</label>
                        <input type="text" name="RefG" id="RefG" class="form-control" value="<?php echo $C_cavalier->getCavalierRefG($oneCavalier['RefG']); ?>" onkeyup="autocompletRefG()" required>
                        <div id="nom_list_idRefG" class="list-group"></div>
                        <input type="hidden" name="idGalop" id="idGalop" value="<?php echo $oneCavalier['RefG']; ?>">
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
