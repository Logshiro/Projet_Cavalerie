<?php
// Par Quentin Mitou
session_start();
// include_once __DIR__ . '/../modele/fonction/conexion_v.php';

require 'vue_header.php';
// Modifier le chemin pour utiliser le chemin absolu depuis la racine du projet
require_once __DIR__ . '/../class/class_cours.php'; 
require_once __DIR__ . '/../class/class_concours.php'; 
require_once __DIR__ . '/../class/class_participe.php'; 

$charge = true;
$content = ''; // Variable pour stocker le contenu à afficher

//On vérifie si l'action est définie dans l'url
if(isset($_GET['action'])){
    //On vérifie l'action
    switch($_GET['action']){
        case 'add': // Ajouter un concours
        ob_start();
        require_once '../Controleur/Concours/add_concours.php';
        $content = ob_get_clean();
        break;
    case 'Voir': // Voir un concours
        ob_start();
        require_once '../Controleur/Concours/détail_concours.php';
        $content = ob_get_clean();
        break;
    case 'Modifier': // Modifier un concours
        ob_start();
        require_once '../Controleur/Concours/edit_concours.php';
        $content = ob_get_clean();
        break;
    case 'Supprimer': // Supprimer un concours
        ob_start();
        require_once '../Controleur/Concours/delete_concours.php';
        $content = ob_get_clean();
        break;
    default:
        $content = '<div class="alert alert-warning">Action non reconnue</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Concours</title>

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
                <h1>Liste des Concours</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Libellé</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // On crée un nouvel objet Concours
                        $concours = new Concours("", "", "");
                        // On récupère tous les concours
                        $allConcours = $concours->getAllConcours(); // Correction : on appelle la méthode correcte

                        // On parcourt toutes les lignes de la table
                        foreach ($allConcours as $ligne) {
                            ?>
                            <tr>
                                <!-- On affiche le libellé du concours -->
                                <td><?= htmlspecialchars($ligne['LibConcours']); ?></td>
                                <!-- On affiche la date du concours -->
                                <td><?= htmlspecialchars($ligne['DateConcours']); ?></td>
                                <td>
                                    <!-- On crée les liens d'action -->
                                    <a href="vue_concours.php?id=<?= htmlspecialchars($ligne['idConcours']); ?>&action=Voir" class="btn btn-primary">Voir</a>
                                    <a href="vue_concours.php?id=<?= htmlspecialchars($ligne['idConcours']); ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                    <a href="vue_concours.php?id=<?= htmlspecialchars($ligne['idConcours']); ?>&action=Supprimer" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="action-buttons">
                    <a href="vue_concours.php?action=add" class="btn btn-primary">Ajouter un Concours</a>
                    <a href="../Class/PDF/class_ConcoursPDF.php" target="_blank" class="btn btn-pdf">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>
                <?php
                }
                ?>
            </section>
        </div>
    </main>
</body>
</html>
