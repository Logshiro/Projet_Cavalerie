<?php
// Démarrage de la session pour gérer les messages de succès/erreur
session_start();

// Inclusion des fichiers nécessaires
require 'vue_header.php'; // Contient probablement le code de l'en-tête HTML commun
require_once '../../../Controleur/Class/class_Organisation.php'; // Classe Organisation utilisée pour les manipulations des données

// Récupération des données via les paramètres GET
$idInfo = isset($_GET['idInfo']) ? $_GET['idInfo'] : ''; // Identifiant d'information
$idCompetition = isset($_GET['idCompetition']) ? $_GET['idCompetition'] : ''; // Identifiant de compétition
$isEditing = !empty($idInfo) && !empty($idCompetition); // Détermine si le mode édition est activé

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir'); // Affichage des détails
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'Ajouter' || $_GET['action'] === 'Modifier'); // Ajout ou modification
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Configuration de base de la page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Organisations</title>
    <!-- Lien vers le framework CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Inclusion des scripts nécessaires -->
    <script src="../../../Modele/Js/Script_Organisation.js" type="text/javascript"></script>
    <script src="../../../Modele/Js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container mt-5">

    <h1 class="mb-4">Gestion des Organisations</h1>

    <!-- Affichage des messages de succès/erreur -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); // Message de succès ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['erreur'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['erreur']); unset($_SESSION['erreur']); // Message d'erreur ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire de visualisation -->
    <?php if ($formVisible1): 
        $Organisation = new Organisation("", ""); // Création d'une instance vide pour récupérer les informations
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails de l'Organisation <?= $Organisation->getInfoOrganisation($idInfo); ?></h3> <!-- Affiche les détails -->
                    <p>Info : <?= $Organisation->getInfoOrganisation($idInfo); ?></p>
                    <p>Competition : <?= $Organisation->getCompetitionOrganisation($idCompetition); ?></p>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $Organisation = new Organisation("", ""); // Instance pour la récupération de données
        ?>
        <main class="container">
            <form method="post" action="../../../Controleur/Crud/Organisation/traitement_Organisation.php" class="mb-4">
                <h3><?= $isEditing ? 'Modifier une Organisation' : 'Ajouter une Organisation'; ?></h3>
                <div class="form-group mb-3">
                    <label for="RefInfo">ID Info</label>
                    <!-- Champ d'autocomplétion pour l'ID Info -->
                    <input type="text" name="RefInfo" id="RefInfo" class="form-control"
                        value="<?= !empty($idInfo) ? $Organisation->getInfoOrganisation($idInfo) : '' ?>" onkeyup="autocompletInfoI()" required>
                    <div id="nom_list_idInfoI" class="list-group"></div>
                    <!-- Champ caché pour stocker l'ID Info -->
                    <input type="hidden" name="idInfo" id="idInfo" value="<?= !empty($idInfo) ? $idInfo : '' ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="RefCompetition">ID Compétition</label>
                    <!-- Champ d'autocomplétion pour l'ID Compétition -->
                    <input type="text" name="RefCompetition" id="RefCompetition" class="form-control"
                        value="<?= !empty($idCompetition) ? $Organisation->getCompetitionOrganisation($idCompetition) : '' ?>" onkeyup="autocompletCompetitionI()" required>
                    <div id="nom_list_idCompetitionI" class="list-group"></div>
                    <!-- Champ caché pour stocker l'ID Compétition -->
                    <input type="hidden" name="idCompetition" id="idCompetition" value="<?= !empty($idCompetition) ? $idCompetition : '' ?>">
                </div>
                <!-- Champs cachés pour conserver les anciennes valeurs en mode édition -->
                <?php if ($isEditing): ?>
                    <input type="hidden" name="idInfo_old" value="<?= htmlspecialchars($idInfo); ?>">
                    <input type="hidden" name="idCompetition_old" value="<?= htmlspecialchars($idCompetition); ?>">
                <?php endif; ?>
                <button type="submit" name="action" value="<?= $isEditing ? 'Modifier' : 'Ajouter'; ?>" class="btn btn-primary">
                    <?= $isEditing ? 'Modifier' : 'Ajouter'; ?>
                </button>
            </form>
        </main>
    <?php endif; ?>

    <!-- Tableau affichant les organisations existantes -->
    <table class="table">
        <thead>
            <tr>
                <th>Info</th>
                <th>Competition</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $Organisation = new Organisation("", ""); // Création d'une instance
        $allOrganisation = $Organisation->Organisation_all(); // Récupération de toutes les organisations

        if ($allOrganisation && is_array($allOrganisation)) { // Vérification si des données sont disponibles
            foreach ($allOrganisation as $ligne) : ?>
                <tr>
                    <td><?= $Organisation->getInfoOrganisation($ligne['RefInfo']); ?></td>
                    <td><?= $Organisation->getCompetitionOrganisation($ligne['RefCompetition']); ?></td>
                    <td>
                        <!-- Boutons d'action pour chaque ligne -->
                        <a href="?idInfo=<?= urlencode($ligne['RefInfo']); ?>&idCompetition=<?= urlencode($ligne['RefCompetition']); ?>&action=Voir" class="btn btn-primary">Voir</a>
                        <a href="?idInfo=<?= urlencode($ligne['RefInfo']); ?>&idCompetition=<?= urlencode($ligne['RefCompetition']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                        <form method="post" action="../../../Controleur/Crud/Organisation/traitement_Organisation.php" style="display:inline-block;">
                            <input type="hidden" name="idInfo" value="<?= htmlspecialchars($ligne['RefInfo']); ?>">
                            <input type="hidden" name="idCompetition" value="<?= htmlspecialchars($ligne['RefCompetition']); ?>">
                            <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;
        } else { ?>
            <tr>
                <td colspan="3" class="text-center">Aucune organisation trouvée.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- Bouton pour ajouter une nouvelle organisation -->
    <div class="action-buttons">
        <a href="?action=Ajouter" class="btn btn-primary">Ajouter Organisation</a>
    </div>

</div>
</body>