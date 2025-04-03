<?php
// Par Quentin Mitou

// On vérifie si le formulaire est envoyé
if ($_POST) {
    // On vérifie si les champs sont remplis
    if (
        isset($_POST['Libconcours']) && !empty($_POST['Libconcours']) 
        && isset($_POST['Dateconcours']) && !empty($_POST['Dateconcours'])
    ) {

        // On nettoie les données
        $Libconcours = strip_tags($_POST['Libconcours']);
        $Dateconcours = strip_tags($_POST['Dateconcours']);
        
        // On crée un nouvel objet Concours
        $Concours = new Concours("", $Libconcours, $Dateconcours);
        // On ajoute le concours
        $Concours->addConcours();

        // On redirige vers la page de la liste des concours
        $_SESSION['message'] = "Concours ajouté avec succès";
        header('Location: vue_concours.php');
        die();
    } else {
        // Si les champs ne sont pas remplis, afficher un message d'erreur
        $_SESSION['erreur'] = "Tous les champs sont requis";
        header('Location: vue_concours.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Concours</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_concours.js"></script>
    <script src="../Js/jquery.min.js"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Ajouter un Concours</h1>

                <!-- Affichage des messages d'erreur ou de succès -->
                <?php if (isset($_SESSION['erreur'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <!-- On crée un formulaire pour ajouter un concours -->
                <form method="post" id="concoursForm">
                    <div class="form-group">
                        <label for="Libconcours">Libellé du Concours :</label>
                        <input type="text" name="Libconcours" id="Libconcours" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Dateconcours">Date du Concours :</label>
                        <input type="date" name="Dateconcours" id="Dateconcours" class="form-control" required>
                    </div>

                    <!-- Bouton pour envoyer le formulaire -->
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>

    <script>
        // Vous pouvez ajouter des fonctions JavaScript pour gérer des événements de formulaire supplémentaires
    </script>
</body>
</html>
