<?php
// Par Quentin Mitou

//On vérifie si le formulaire est envoyé
if($_POST){
    //On vérifie si les champs sont remplis
    if(isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST['LibRace']) && !empty($_POST['LibRace'])){

        //On nettoie les données
        $id = strip_tags($_POST['id']);
        $LibRace = strip_tags($_POST['LibRace']);
            
        //On crée un nouvel objet Race
        $race = new Race($id, $LibRace);
        
        //afficher la race
        $oneRace = $race->edit();

        //On affiche un message de succès
        $_SESSION['message'] = "Galop modifié avec succès";
        //On redirige vers la page de la liste
        header('Location: vue_race.php');
        die();

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_race.php');
        die();
    }
}else{
    //on vérifie si l'id est défini et non vide dans l'url
    if(isset($_GET['id']) && !empty($_GET['id'])){ 

        //on nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        //on instancie un objet race
        $race = new Race($id,"");
        //On récupère la race par son id
        $oneRace = $race->race_id($id);

        //la race n'existe pas
        if(!$oneRace){
            //On affiche un message d'erreur
            $_SESSION['erreur'] = "Aucune Race trouvée pour cet id";  
            //On redirige vers la page de la liste
            header('Location: vue_race.php');
            die();
        }

    }else{
        //On affiche un message d'erreur
        $_SESSION['erreur'] = "url invalide";  
        //On redirige vers la page de la liste
        header('Location: vue_race.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Race</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <!-- On affiche un titre -->
                <h1>Modifier la Race</h1>
                <!-- On crée un formulaire pour modifier une race -->
                <form method="post">
                    <div class="form-group">
                        <!-- On crée un label pour le prix -->
                        <label for="LibRace">Libellé de la Race :</label>
                        <!-- On crée un champ pour le prix -->
                        <input type="text" name="LibRace" id="LibRace" class="form-control" value="<?php echo $oneRace['LibRace']; ?>" required>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <!-- On crée un bouton pour envoyer le formulaire -->
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
