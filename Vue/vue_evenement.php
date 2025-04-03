<?php
// Par Quentin Mitou
// include_once __DIR__ . '/../modele/fonction/conexion_v.php';

require 'vue_header.php';
// Modifier le chemin pour utiliser le chemin absolu depuis la racine du projet
require_once __DIR__ . '/../Class/class_evenement.php';
// Vérification préalable pour éviter les conflits avec controleurPrincipal.php
if (!isset($_GET['action']) || in_array($_GET['action'], ['add', 'Voir', 'Modifier', 'Supprimer'])) {
//On vérifie si l'action est définie dans l'url
if(isset($_GET['action'])){
    //On vérifie l'action
    switch($_GET['action']){
        case 'add': //Ajouter un evenement
        ob_start();
        require_once '../Controleur/Evenement/PHP_CRUD_Evenement/add_evenement.php';
        $content = ob_get_clean();
        break;
    case 'Voir': //Voir un evenement  
        ob_start();
        require_once '../Controleur/Evenement/PHP_CRUD_Evenement/detail_evenement.php';
        $content = ob_get_clean();
        break;
    case 'Modifier': //Modifier un evenement
        ob_start();
        require_once '../Controleur/Evenement/PHP_CRUD_Evenement/edit_evenement.php';
        $content = ob_get_clean();
        break;
    case 'Supprimer': //Supprimer un evenement
        ob_start();
        require_once '../Controleur/Evenement/PHP_CRUD_Evenement/delete_evenement.php';
        $content = ob_get_clean();
        break;
    default:
        $content = '<div class="alert alert-warning">Action non reconnue</div>';
    }
}
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Evenements</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class = "col-12">
                <?php
                //On vérifie si un message d'erreur est présent
                if(isset($_SESSION['erreur'])){
                    echo "<div class='alert alert-danger'>".$_SESSION['erreur']."</div>";
                    unset($_SESSION['erreur']);
                }
                //On vérifie si un message de succès est présent
                if(isset($_SESSION['message'])){
                    echo "<div class='alert alert-success'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }

                // Si on a du contenu spécifique à une action, on l'affiche
                if(!empty($content)){
                    echo $content;
                } else {
                ?>
                <h1>Liste des Evenements</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th>Commentaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //On crée un nouvel objet Liste
                        $evenement = new Evenement("","","");
                        //On récupère toutes les lignes de la table
                        $allEvenement = $evenement->evenement_all();
                        //on parcourt toutes les lignes de la table
                        foreach ($allEvenement as $ligne) {
                            ?>
                            <tr>
                                <!-- On affiche l'id du produit -->
                                <td><?= $ligne['idEvenement']; ?></td>
                                <!-- On affiche le produit -->
                                <td><?= $ligne['TitreE']; ?></td>
                                <!-- On affiche le prix du produit -->
                                <td><?= $ligne['CommentaireE']; ?></td>
                                <!-- On crée un lien pour voir les détails du produit -->
                                <td><a href="vue_evenement.php?id=<?= $ligne['idEvenement']; ?>&action=Voir" class="btn btn-primary">Voir</a>
                                <a href="vue_evenement.php?id=<?= $ligne['idEvenement']; ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                <a href="vue_evenement.php?id=<?= $ligne['idEvenement']; ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form method="get">
                <div class="action-buttons">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter un Evenement</button>
                        </form>
                        <a href="../Class/PDF/class_EvenementPDF.php" target="_blank" class="btn btn-pdf">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                </form>
                <?php
            }
            ?>
        </section>
    </div>
    
</main>
</body>
</html>
