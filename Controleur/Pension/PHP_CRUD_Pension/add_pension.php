<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(
        isset($_POST['Tarifs']) && !empty($_POST['Tarifs']) 
        && isset($_POST['LibPension']) && !empty($_POST['LibPension'])
        && isset($_POST['DateDebutP']) && !empty($_POST['DateDebutP'])
        && isset($_POST['DateFinP']) && !empty($_POST['DateFinP'])
        && isset($_POST['idSir']) && !empty($_POST['idSir'])
        && isset($_POST['idCL']) && !empty($_POST['idCL'])
        ){

        //On nettoie les données
        $Tarifs = strip_tags($_POST['Tarifs']);
        $LibPension = strip_tags($_POST['LibPension']);
        $DateDebutP = strip_tags($_POST['DateDebutP']);
        $DateFinP = strip_tags($_POST['DateFinP']);
        $RefNumSir = strip_tags($_POST['idSir']);

        // Handle multiple riders
        $success = true;
        foreach($_POST['idCL'] as $RefCavalier) {
            $RefCavalier = strip_tags($RefCavalier);
            //On crée un nouvel objet Pension pour chaque cavalier
            $Pension = new Pension("", $Tarifs, $LibPension, $DateDebutP, $DateFinP, $RefNumSir, $RefCavalier);
            //On ajoute la pension
            if(!$Pension->add()) {
                $success = false;
                break;
            }
            
            // Récupérer l'ID de la pension nouvellement créée depuis la base de données
            $newPensionId = $Pension->getLastInsertId();
            
            // Vérifier que l'ID a bien été récupéré
            if(!$newPensionId) {
                $success = false;
                break;
            }
            
            // Créer l'association dans la table prend
            $Prend = new Prend($RefCavalier, $newPensionId);
            if(!$Prend->add()) {
                $success = false;
                break;
            }
        }

        if($success) {
            $_SESSION['message'] = "Pension(s) ajoutée(s) avec succès";
        } else {
            $_SESSION['erreur'] = "Erreur lors de l'ajout des pensions";
        }
        
        header('Location: vue_pension.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        //On redirige vers la page de la pension
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
    <title>Ajouter une Pension</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_pension.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="../Js/addPhotos.js" type="text/javascript"></script> -->
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter une Pension</h1>
                <!-- On crée un formulaire pour ajouter une pension -->
                <form method="post" id="pensionForm">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="Tarifs">Tarifs :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="number" name="Tarifs" id="Tarifs" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la date de naissance -->
                        <label for="LibPension">Libellé de la pension :</label>
                        <!-- On crée un champ pour la date de naissance -->
                        <input type="text" name="LibPension" id="LibPension" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la photo -->
                        <label for="DateDebutP">Date de début de la pension :</label>
                        <!-- On crée un champ pour la date de début de la pension -->
                        <input type="date" name="DateDebutP" id="DateDebutP" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour la date de fin de la pension -->
                        <label for="DateFinP">Date de fin de la pension :</label>
                        <!-- On crée un champ pour la date de fin de la pension -->
                        <input type="date" name="DateFinP" id="DateFinP" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <!-- On crée un label pour le numsir du cheval -->
                        <label for="RefNumSir">Nom du cheval :</label>
                        <!-- On crée un champ pour le numsir du cheval -->
                        <input type="text" name="RefNumSir" id="RefNumSir" class="form-control" onkeyup="autocomplet_InsertCa()" required>
                        <div id="nom_list_idCaI" class="list-group"></div>
                        <input type="hidden" name="idSir" id="idSir">
                    </div>
                    <div class="form-group" id="cavalierFields">
                        <!-- On crée un label pour le numsir du cavalier -->
                        <label for="RefCavalier">Nom du cavalier :</label>
                        <!-- On crée un champ pour le numsir du cavalier -->
                        <input type="text" id="RefCavalier" name="RefCavalier[]" class="form-control" onkeyup="autocomplet_InsertCL()" required>
                        <div id="nom_list_idCLI" class="list-group"></div>
                        <input type="hidden" name="idCL[]" id="idCL">
                    </div>
                    <!-- Bouton pour ajouter un autre cavalier -->
                    <button type="button" class="btn btn-secondary" onclick="addCavalierField()">Ajouter un autre cavalier</button>
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
