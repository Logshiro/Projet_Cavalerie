<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST['idPension']) && !empty($_POST['idPension'])
        && isset($_POST['Tarifs']) && !empty($_POST['Tarifs']) 
        && isset($_POST['LibPension']) && !empty($_POST['LibPension'])
        && isset($_POST['DateDebutP']) && !empty($_POST['DateDebutP'])
        && isset($_POST['DateFinP']) && !empty($_POST['DateFinP'])
        && isset($_POST['idSir']) && !empty($_POST['idSir'])){

        //On nettoie les données
        $idPension = strip_tags($_POST['idPension']);
        $Tarifs = strip_tags($_POST['Tarifs']);
        $LibPension = strip_tags($_POST['LibPension']);
        $DateDebutP = strip_tags($_POST['DateDebutP']);
        $DateFinP = strip_tags($_POST['DateFinP']);
        $idSir = strip_tags($_POST['idSir']);
        $idCL = strip_tags($_POST['idCL']);

        //On crée un nouvel objet Cavalerie
        $pension = new Pension( $idPension, $Tarifs, $LibPension, $DateDebutP, $DateFinP, $idSir, $idCL);
        
        //afficher le produit
        $onePension = $pension->edit();

        //On affiche un message de succès
        $_SESSION['message'] = "Pension modifiée avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_pension.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_pension.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet pension
        $C_pension = new Pension($id,"","","","","");
        //On récupère le produit par son id
        $onePension = $C_pension->pension_id($id);

        //le produit n'existe pas
        if(!$onePension){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucun produit trouvé pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_pension.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_pension.php');
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
                <h1>Modifier la Pension</h1>
                <!-- On crée un formulaire pour ajouter un produit -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="NomCheval">Tarifs :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="Tarifs" id="Tarifs" class="form-control" value="<?php echo $onePension['Tarifs']; ?>" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le nombre -->
                        <label for="LibPension">LibPension :</label>
                        <!-- On crée un champ pour le nombre -->
                        <input type="text" name="LibPension" id="LibPension" class="form-control" value="<?php echo $onePension['LibPension']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="DateDebutP">DateDebutP :</label>
                        <input type="text" name="DateDebutP" id="DateDebutP" class="form-control" value="<?php echo $onePension['DateDebutP']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="DateFinP">DateFinP :</label>
                        <input type="text" name="DateFinP" id="DateFinP" class="form-control" value="<?php echo $onePension['DateFinP']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="RefNumSir">Cheval :</label>
                        <input type="text" name="RefNumSir" id="RefNumSir" class="form-control" value="<?php echo $C_pension->getPensionCavalerie($onePension['RefNumSir']); ?>" onkeyup="autocompletCa()" required>
                        <div id="nom_list_idCa" class="list-group"></div>
                        <input type="hidden" name="idSir" id="idSir" value="<?php echo $onePension['RefNumSir']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="RefCavalier">Cavalier :</label>
                        <input type="text" name="RefCavalier" id="RefCavalier" class="form-control" value="<?php echo $C_pension->getpensionCavalier($onePension['RefCavalier']); ?>" onkeyup="autocompletCL()" required>
                        <div id="nom_list_idCL" class="list-group"></div>
                        <input type="hidden" name="idCL" id="idCL" value="<?php echo $onePension['RefCavalier']; ?>">
                    </div>
                    <input type="hidden" name="idPension" id="idPension" value="<?php echo $id; ?>">
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
