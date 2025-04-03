<?php
// Par Quentin Mitou
session_start();

require 'vue_header.php';

require_once '../Class/class_liste.php';

//On vérifie si l'action est définie dans l'url
if(isset($_GET['action'])){
    //On vérifie l'action
    switch($_GET['action']){
        case 'add': //Ajouter un produit
        require_once '../Controleur/Liste/PHP_CRUD_Liste/add_liste.php';
        break;
    case 'Voir': //Voir un produit  
        require_once '../Controleur/Liste/PHP_CRUD_Liste/détail_liste.php';
        break;
    case 'Modifier': //Modifier un produit
        require_once '../Controleur/Liste/PHP_CRUD_Liste/edit_liste.php';
        break;
    case 'Supprimer': //Supprimer un produit
        require_once '../Controleur/Liste/PHP_CRUD_Liste/delete_liste.php';
        break;
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
                ?>
                <h1>Liste des Produits</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Nombre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //On crée un nouvel objet Liste
                        $liste = new Liste("","","","");
                        //On récupère toutes les lignes de la table
                        $allListe = $liste->liste_all();
                        //on parcourt toutes les lignes de la table
                        foreach ($allListe as $ligne) {
                            ?>
                            <tr>
                                <!-- On affiche l'id du produit -->
                                <td><?= $ligne['id']; ?></td>
                                <!-- On affiche le produit -->
                                <td><?= $ligne['produit']; ?></td>
                                <!-- On affiche le prix du produit -->
                                <td><?= $ligne['prix']; ?></td>
                                <!-- On affiche le nombre de produit -->
                                <td><?= $ligne['nombre']; ?></td>
                                <!-- On crée un lien pour voir les détails du produit -->
                                <td><a href="vue_liste.php?id=<?= $ligne['id']; ?>&action=Voir" class="btn btn-primary">Voir</a>
                                <a href="vue_liste.php?id=<?= $ligne['id']; ?>&action=Modifier" class="btn btn-warning">Modifier</a>
                                <a href="vue_liste.php?id=<?= $ligne['id']; ?>&action=Supprimer" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- On crée un lien pour ajouter un produit -->
                <a href="vue_liste.php?action=add" class="btn btn-primary">Ajouter un Produit</a>
            </section>
        </div>
    </main>
</body>
