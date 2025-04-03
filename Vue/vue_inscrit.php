<?php
// Par Quentin Mitou
session_start();
// include_once __DIR__ . '/../modele/fonction/conexion_v.php';

require 'vue_header.php';

require_once __DIR__ . '/../class/class_inscrit.php'; 
// Vérification préalable pour éviter les conflits avec controleurPrincipal.php
if (!isset($_GET['action']) || in_array($_GET['action'], ['add', 'Voir', 'Modifier', 'Supprimer'])) {
    // Le reste du code reste inchangé
    $charge = true;
    $content = '';
    
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                ob_start();
                require_once '../Controleur/inscrit/PHP_CRUD_Inscrit/add_inscrit.php';
                $content = ob_get_clean();
                break;
            case 'Voir':
                ob_start();
                require_once '../Controleur/inscrit/PHP_CRUD_Inscrit/détail_inscrit.php';
                $content = ob_get_clean();
                break;
            case 'Modifier':
                ob_start();
                require_once '../Controleur/inscrit/PHP_CRUD_Inscrit/edit_inscrit.php';
                $content = ob_get_clean();
                break;
            case 'Supprimer':
                ob_start();
                require_once '../Controleur/inscrit/PHP_CRUD_Inscrit/delete_inscrit.php';
                $content = ob_get_clean();
                break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produis</title>

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
                <h1>Liste des Inscrits</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cavalier</th>
                            <th>Cours</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //On crée un nouvel objet Inscrit
                        $inscrit = new Inscrit("","");
                        //On récupère toutes les lignes de la table
                        $allInscrit = $inscrit->inscrit_all();
                        //on parcourt toutes les lignes de la table
                        foreach ($allInscrit as $ligne) {
                            ?>
                            <tr>
                                <td><?= $inscrit->getCavalierInscrit($ligne['RefCavalier']); ?></td>
                                <td><?= $inscrit->getCoursInscrit($ligne['RefCours']); ?></td>
                                <td><a href="vue_inscrit.php?id1=<?= $ligne['RefCavalier']; ?>&id2=<?= $ligne['RefCours']; ?>&action=Voir" class="btn btn-primary">Voir</a>
                                <a href="vue_inscrit.php?id1=<?= $ligne['RefCavalier']; ?>&id2=<?= $ligne['RefCours']; ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                <a href="vue_inscrit.php?id1=<?= $ligne['RefCavalier']; ?>&id2=<?= $ligne['RefCours']; ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form method="get">
                <div class="action-buttons">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Inscription</button>
                        </form>
                        <a href="../Class/PDF/class_InscritPDF.php" target="_blank" class="btn btn-pdf">
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
