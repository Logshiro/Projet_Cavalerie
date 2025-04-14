<?php
// Par Quentin Mitou
// include_once __DIR__ . '/../modele/fonction/conexion_v.php';

require 'vue_header.php';

// Modifier le chemin pour utiliser le chemin absolu depuis la racine du projet
require_once __DIR__ . '/../Class/class_pension.php';
require_once __DIR__ . '/../Class/class_Prend.php';

//On vérifie si l'action est définie dans l'url
if(isset($_GET['action'])){
    //On vérifie l'action
    switch($_GET['action']){
        case 'add': //Ajouter une pension
        ob_start();
        require_once '../Controleur/Pension/PHP_CRUD_Pension/add_pension.php';
        $content = ob_get_clean();
        break;
        case 'Voir': //Voir une pension  
        ob_start();
        require_once '../Controleur/Pension/PHP_CRUD_Pension/detail_pension.php';
        $content = ob_get_clean();
        break;
    case 'Modifier': //Modifier une pension
        ob_start();
        require_once '../Controleur/Pension/PHP_CRUD_Pension/edit_pension.php';
        $content = ob_get_clean();
        break;
    case 'Supprimer': //Supprimer une pension
        ob_start();
        require_once '../Controleur/Pension/PHP_CRUD_Pension/delete_pension.php';
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
    <title>Liste des Pensions</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../Js/Script_pension.js" type="text/javascript"></script>
    <script src="../Js/jquery.min.js" type="text/javascript"></script>
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
                <h1>Liste des Pensions</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Pension</th>
                            <th>Tarifs</th>
                            <th>Date Debut</th>
                            <th>Date Fin</th>
                            <th>Cheval</th>
                            <th>Cavalier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //On crée un nouvel objet Pension
                        $C_pension = new Pension("","","","","","");
                        //On récupère toutes les lignes de la table
                        $allPension = $C_pension->pension_all();
                        //on parcourt toutes les lignes de la table
                        foreach ($allPension as $pension) {
                            //On vérifie si la pension est supprimée
                            ?>
                            <tr>
                                <!-- On affiche le numsir de la pension SELECT idPension, Tarifs, LibPension, DateDebutP, DateFinP, RefNumSir-->
                                <td><?= $pension['idPension']; ?></td>
                                <!-- On affiche le nom de la pension -->
                                <td><?= $pension['LibPension']; ?></td>
                                <!-- On affiche le tarif de la pension -->
                                <td><?= $pension['Tarifs']; ?></td>
                                <!-- On affiche la date de début de la pension -->
                                <td><?= $pension['DateDebutP']; ?></td>
                                <!-- On affiche la date de fin de la pension -->
                                <td><?= $pension['DateFinP']; ?></td>
                                <!-- On affiche le numsir du cheval -->
                                <td><?= $C_pension->getPensionCavalerie($pension['RefNumSir']); ?></td>
                                <!-- On affiche le nom du cavalier -->
                                <td><?= $C_pension->getpensionCavalier($pension['RefCavalier']); ?>
                                <td><a href="vue_pension.php?id=<?= $pension['idPension']; ?>&action=Voir" class="btn btn-primary">Voir</a>
                                <a href="vue_pension.php?id=<?= $pension['idPension']; ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                <a href="vue_pension.php?id=<?= $pension['idPension']; ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form method="get">
                    <div class="action-buttons">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Pension</button>
                        </form>
                        <a href="../Class/PDF/class_PensionPDF.php" target="_blank" class="btn btn-pdf">
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
