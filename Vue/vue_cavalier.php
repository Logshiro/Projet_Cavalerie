<?php
// Par Quentin Mitou
session_start();
require "vue_header.php";
// Modifier le chemin pour utiliser le chemin absolu depuis la racine du projet
require_once __DIR__ . '/../Class/class_cavalier.php';
$action = isset($_GET['action']) ? $_GET['action'] : null;
// Vérification préalable pour éviter les conflits avec controleurPrincipal.php
if (!isset($_GET['action']) || in_array($_GET['action'], ['add', 'Voir', 'Modifier', 'Supprimer'])) {
    // Le reste du code reste inchangé
    $charge = true;
    $content = '';
    
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                ob_start();
                require_once '../Controleur/Cavalier/PHP_CRUD_Cavalier/add_cavalier.php';
                $content = ob_get_clean();
                break;
            case 'Voir':
                ob_start();
                require_once '../Controleur/Cavalier/PHP_CRUD_Cavalier/détail_cavalier.php';
                $content = ob_get_clean();
                break;
            case 'Modifier':
                ob_start();
                require_once '../Controleur/Cavalier/PHP_CRUD_Cavalier/edit_cavalier.php';
                $content = ob_get_clean();
                break;
            case 'Supprimer':
                ob_start();
                require_once '../Controleur/Cavalier/PHP_CRUD_Cavalier/delete_cavalier.php';
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
    <title>Liste des Cavaliers</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="Js/Script_cavalier.js" type="text/javascript"></script>
    <script src="Js/jquery.min.js" type="text/javascript"></script>
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
                <h1>Liste des Cavaliers</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NumLicence</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Galop</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //On crée un nouvel objet Cavalier
                        $C_cavalier = new Cavalier("","","","","","","","","","","","","","");
                        //On récupère toutes les lignes de la table
                        $allCavalier = $C_cavalier->cavalier_all();
                        //on parcourt toutes les lignes de la table
                        foreach ($allCavalier as $cavalier) {
                            ?>
                            <tr>
                                <!-- On affiche l'id du produit -->
                                <td><?= $cavalier['idCavalier']; ?></td>
                                <!-- On affiche le numsir du produit -->
                                <td><?= $cavalier['Numlicence']; ?></td>
                                <!-- On affiche le nom du produit -->
                                <td><?= $cavalier['NomCavalier']; ?></td>
                                <!-- On affiche le prénom du produit -->
                                <td><?= $cavalier['PrenomCavalier']; ?></td>
                                <!-- On affiche la date de naissance du produit -->
                                <td><?= $cavalier['DateNaissanceCavalier']; ?></td>
                                <!-- On affiche la référence de la génération du produit -->
                                <td><?= $C_cavalier->getCavalierRefG($cavalier['RefG']); ?></td>
                                <!-- On crée un lien pour voir les détails du produit -->
                                <td><a href="vue_cavalier.php?id=<?= $cavalier['idCavalier']; ?>&action=Voir" class="btn btn-primary">Voir</a>
                                <a href="vue_cavalier.php?id=<?= $cavalier['idCavalier']; ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                <a href="vue_cavalier.php?id=<?= $cavalier['idCavalier']; ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form method="get">
                <div class="action-buttons">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter un Cavalier</button>
                        </form>
                        <a href="../Class/PDF/class_CavalierPDF.php" target="_blank" class="btn btn-pdf">
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
