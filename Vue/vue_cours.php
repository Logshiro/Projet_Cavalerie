<?php
// Par Quentin Mitou
session_start();
// include_once __DIR__ . '/../modele/fonction/conexion_v.php';

require 'vue_header.php';
// Modifier le chemin pour utiliser le chemin absolu depuis la racine du projet
require_once __DIR__ . '/../class/class_cours.php'; 
require_once __DIR__ . '/../class/class_inscrit.php'; 
require_once __DIR__ . '/../class/class_participe.php'; 

// Vérification préalable pour éviter les conflits avec controleurPrincipal.php
if (!isset($_GET['action']) || in_array($_GET['action'], ['add', 'Voir', 'Modifier', 'Supprimer'])) {

$charge = true;
$content = ''; // Variable pour stocker le contenu à afficher

//On vérifie si l'action est définie dans l'url
if(isset($_GET['action'])){
    //On vérifie l'action
    switch($_GET['action']){
        case 'add': //Ajouter un produit
        ob_start();
        require_once '../Controleur/Cours/PHP_CRUD_Cours/add_cours.php';
        $content = ob_get_clean();
        break;
    case 'Voir': //Voir un produit  
        ob_start();
        require_once '../Controleur/Cours/PHP_CRUD_Cours/détail_cours.php';
        $content = ob_get_clean();
        break;
    case 'Modifier': //Modifier un produit
        ob_start();
        require_once '../Controleur/Cours/PHP_CRUD_Cours/edit_cours.php';
        $content = ob_get_clean();
        break;
    case 'Supprimer': //Supprimer un produit
        ob_start();
        require_once '../Controleur/Cours/PHP_CRUD_Cours/delete_cours.php';
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
    <title>Liste des Cours</title>

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
                <h1>Liste des Cours</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Libellé</th>
                            <th>Jour</th>
                            <th>Heure de début</th>
                            <th>Heure de fin</th>
                            <th>Galop</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //On crée un nouvel objet Cours
                        $cours = new Cours("","","","","","");
                        //On récupère toutes les lignes de la table
                        $allCours = $cours->cours_all();
                        //on parcourt toutes les lignes de la table
                        foreach ($allCours as $ligne) {
                            ?>
                            <tr>
                                <!-- On affiche l'id du produit -->
                                <td><?= htmlspecialchars($ligne['idCours']); ?></td>
                                <!-- On affiche le produit -->
                                <td><?= htmlspecialchars($ligne['Libcours']); ?></td>
                                <!-- On affiche le prix du produit -->
                                <td><?= htmlspecialchars($ligne['jour']); ?></td>
                                <!-- On affiche le nombre de produit -->
                                <td><?= htmlspecialchars($ligne['HD']); ?></td>
                                <!-- On affiche le nombre de produit -->
                                <td><?= htmlspecialchars($ligne['HF'])  ; ?></td>
                                <td><?= htmlspecialchars($cours->getCours_Galop($ligne['RefGalop'])); ?></td>
                                <!-- On crée un lien pour voir les détails du produit -->
                                <td><a href="vue_cours.php?id=<?= htmlspecialchars($ligne['idCours']); ?>&action=Voir" class="btn btn-primary">Voir</a>
                                <a href="vue_cours.php?id=<?= htmlspecialchars($ligne['idCours']); ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                <a href="vue_cours.php?id=<?= htmlspecialchars($ligne['idCours']); ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <form method="get">
                    <div class="action-buttons">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter un Cours</button>
                        </form>
                        <a href="../Class/PDF/class_CoursPDF.php" target="_blank" class="btn btn-pdf">
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
