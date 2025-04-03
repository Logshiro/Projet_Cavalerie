<?php
// Par Quentin Mitou



// Vérifier si le formulaire est envoyé
if ($_POST) {
    // Vérification des champs nécessaires
    if (isset($_POST['id']) && !empty($_POST['id']) &&
        isset($_POST['Libconcours']) && !empty($_POST['Libconcours']) &&
        isset($_POST['Dateconcours']) && !empty($_POST['Dateconcours'])) {

        // Nettoyer les données envoyées
        $id = strip_tags($_POST['id']);
        $Libconcours = strip_tags($_POST['Libconcours']);
        $Dateconcours = strip_tags($_POST['Dateconcours']);

        // Créer un objet Concours
        $concours = new Concours($id, $Libconcours, $Dateconcours);

        // Appeler la méthode pour éditer le concours
        $oneConcours = $concours->updateConcours();

        // Vérifier si la modification a réussi
        if ($oneConcours) {
            $_SESSION['message'] = "Concours modifié avec succès";
            header('Location: vue_concours.php');
            die();
        } else {
            $_SESSION['erreur'] = "Erreur lors de la modification du concours";
            header('Location: vue_concours.php');
            die();
        }

    } else {
        // Si des champs sont manquants
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: vue_concours.php');
        die();
    }
} else {
    // Vérifier si l'ID est défini et non vide dans l'URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        // Nettoyer l'ID envoyé dans l'URL
        $id = strip_tags($_GET['id']);

        // Instancier un objet Concours pour récupérer les informations du concours
        $concours = new Concours($id, "", "");
        // Récupérer le concours par son ID
        $oneConcours = $concours->getConcoursById($id);

        // Si le concours n'existe pas
        if (!$oneConcours) {
            $_SESSION['erreur'] = "Aucun concours trouvé pour cet ID";
            header('Location: vue_concours.php');
            die();
        }

    } else {
        // Si l'ID n'est pas valide
        $_SESSION['erreur'] = "URL invalide";
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
    <title>Modifier un Concours</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_concours.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <!-- On affiche un titre -->
                <h1>Modifier un Concours</h1>
                
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

                <!-- Formulaire pour modifier un concours -->
                <form method="post">
                    <div class="form-group">
                        <label for="Libconcours">Libellé :</label>
                        <input type="text" name="Libconcours" id="Libconcours" class="form-control" value="<?php echo htmlspecialchars($oneConcours['LibConcours']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Dateconcours">Date du Concours :</label>
                        <input type="date" name="Dateconcours" id="Dateconcours" class="form-control" value="<?php echo htmlspecialchars($oneConcours['DateConcours']); ?>" required>
                    </div>

                    <!-- Champ caché pour l'id du concours -->
                    <input type="hidden" name="id" id="id" value="<?php echo $oneConcours['idConcours']; ?>">

                    <button class="btn btn-primary">Modifier</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
