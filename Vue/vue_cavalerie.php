<?php
session_start();
require 'vue_header.php';
require_once __DIR__ . '/../Class/class_cavalerie.php';


// Gestion des actions
$action = isset($_GET['action']) ? $_GET['action'] : null;
if (in_array($action, ['add', 'Voir', 'Modifier', 'Supprimer'])) {
    $charge = true;
    $content = ''; // Variable pour stocker le contenu à afficher
    switch($action){
        case 'add':
            ob_start();
            include '../Controleur/Cavalerie/PHP_CRUD_Cavalerie/add_cavalerie.php';
            $content = ob_get_clean();
            break;
        case 'Voir':
            ob_start();
            include '../Controleur/Cavalerie/PHP_CRUD_Cavalerie/détail_cavalerie.php';
            $content = ob_get_clean();
            break;
        case 'Modifier':
            ob_start();
            include '../Controleur/Cavalerie/PHP_CRUD_Cavalerie/edit_cavalerie.php';
            $content = ob_get_clean();
            break;
        case 'Supprimer':
            ob_start();
            include '../Controleur/Cavalerie/PHP_CRUD_Cavalerie/delete_cavalerie.php';
            $content = ob_get_clean();
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cavaleries</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                // Affichage des messages
                if (isset($_GET['message'])) {
                    echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
                }
                if (isset($_SESSION['erreur'])) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['erreur']) . "</div>";
                    unset($_SESSION['erreur']);
                }

                // Si on a du contenu spécifique à une action, on l'affiche
                if(!empty($content)){
                    echo $content;
                } else {
                    // Sinon on affiche la liste par défaut
                    ?>
                    <h1>Liste des Cavaleries</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Date de naissance</th>
                                <th>Garot</th>
                                <th>Race</th>
                                <th>Robe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //On crée un nouvel objet Cavalerie
                            $C_cavalerie = new Cavalerie("","","","","","");
                            //On récupère toutes les lignes de la table
                            $allCavalerie = $C_cavalerie->cavalerie_all();
                            //on parcourt toutes les lignes de la table
                            foreach ($allCavalerie as $cavalerie) {
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($cavalerie['NumSir']); ?></td>
                                    <td><?= htmlspecialchars($cavalerie['NomCheval']); ?></td>
                                    <td><?= htmlspecialchars($cavalerie['DateNC']); ?></td>
                                    <td><?= htmlspecialchars($cavalerie['Garot']); ?></td>
                                    <td><?= htmlspecialchars($C_cavalerie->getCavalerieRace($cavalerie['RefRace'])); ?></td>
                                    <td><?= htmlspecialchars($C_cavalerie->getCavalerieRobe($cavalerie['RefRobe'])); ?></td>
                                    <td>
                                        <form method="get" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($cavalerie['NumSir']); ?>">
                                            <a href="vue_cavalerie.php?id=<?= $cavalerie['NumSir']; ?>&action=Voir" class="btn btn-primary">Voir</a>
                                            <a href="vue_cavalerie.php?id=<?= $cavalerie['NumSir']; ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                            <a href="vue_cavalerie.php?id=<?= $cavalerie['NumSir']; ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                                        </form>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="action-buttons">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Cavalerie</button>
                        </form>
                        <a href="../Class/PDF/class_CavaleriePDF.php" target="_blank" class="btn btn-pdf">
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

