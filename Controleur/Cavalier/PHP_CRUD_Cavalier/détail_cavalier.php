<?php
// Par Quentin Mitou

//on vérifie si l'id est défini et non vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){ 

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    //on instancie un objet cavalier
    $C_cavalier = new Cavalier($id,"","","","","","","","","","","","","");
    //On récupère le produit par son id
    $onecavalier = $C_cavalier->cavalier_id($id);

    //le produit n'existe pas
    if(!$onecavalier){
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
        //On redirige vers la page de la cavalier
        header('Location: vue_cavalier.php');
        die();
    }

}else{
    //On affiche un message d'erreur
    $_SESSION['erreur'] = "url invalide";  
    //On redirige vers la page de la cavalier
    header('Location: vue_cavalier.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>détails du produit</title>
    <!-- On charge la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Détails du produit <?= $onecavalier['NomCavalier']; ?></h1>
                <!-- On affiche les informations du produit -->
                <p>Id : <?= $onecavalier['idCavalier']; ?></p>
                <p>Numlicence : <?= $onecavalier['Numlicence']; ?></p>
                <p>Nom : <?= $onecavalier['NomCavalier']; ?></p>
                <p>Prenom : <?= $onecavalier['PrenomCavalier']; ?></p>
                <p>Date de naissance : <?= $onecavalier['DateNaissanceCavalier']; ?></p>
                <p>Nom du responsable : <?= $onecavalier['NomResponsable']; ?></p>
                <p>Prénom du responsable : <?= $onecavalier['PreNomResponsable']; ?></p>
                <p>Téléphone du responsable : <?= $onecavalier['TelResponsable']; ?></p>
                <p>Mail du responsable : <?= $onecavalier['MailResponsable']; ?></p>
                <p>Mot de passe du responsable : <?= $onecavalier['PasswordResponsable']; ?></p>
                <p>COP du responsable : <?= $onecavalier['COPResponsable']; ?></p>
                <p>Nom de la commune : <?= $onecavalier['Nomcommune']; ?></p>
                <p>Assurance : <?= $onecavalier['Assurance']; ?></p>
                <p>RefG : <?= $C_cavalier->getCavalierRefG($onecavalier['RefG']); ?></p>
            </section>
        </div>
    </main>
</body>
</html>

