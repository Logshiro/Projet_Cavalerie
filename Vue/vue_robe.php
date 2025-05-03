<?php
// Démarrage de la session pour gérer les messages de succès/erreur
session_start();

// Inclusion des fichiers nécessaires
require 'vue_header.php';
require_once __DIR__ . '/../Class/class_robe.php';

// Récupération des données via les paramètres GET
$idRobe = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idRobe);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Robes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Robes</h1>

    <!-- Affichage des messages de succès/erreur -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['erreur'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['erreur']); unset($_SESSION['erreur']); ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire de visualisation -->
    <?php if ($formVisible1): 
        $robe = new Robe("", "");
        $robeData = $robe->robe_id($idRobe);
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails de la Robe</h3>
                    <p><strong>ID :</strong> <?= $robeData['idRobe']; ?></p>
                    <p><strong>Nom :</strong> <?= $robeData['LibRobe']; ?></p>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $robe = new Robe("", "");
        $robeData = $isEditing ? $robe->robe_id($idRobe) : null;
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Robe/PHP_CRUD_Robe/traitement_robe.php" class="mb-4">
                <h3><?= $isEditing ? 'Modifier une Robe' : 'Ajouter une Robe'; ?></h3>
                <div class="form-group mb-3">
                    <label for="LibRobe">Nom de la Robe</label>
                    <input type="text" name="LibRobe" id="LibRobe" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($robeData['LibRobe']) : '' ?>" required>
                    <?php if ($isEditing): ?>
                        <input type="hidden" name="idRobe" value="<?= htmlspecialchars($idRobe); ?>">
                    <?php endif; ?>
                </div>
                <button type="submit" name="action" value="<?= $isEditing ? 'Modifier' : 'Ajouter'; ?>" class="btn btn-primary">
                    <?= $isEditing ? 'Modifier' : 'Ajouter'; ?>
                </button>
            </form>
        </main>
    <?php endif; ?>

    <!-- Tableau affichant les pensions existantes -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th>ID</th>
                <th>Nom Robe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $robe = new Robe("", "");
        $allRobe = $robe->robe_all();

        if ($allRobe && is_array($allRobe)) {
            foreach ($allRobe as $ligne) : ?>
                <tr>
                    <td><?= $ligne['idRobe']; ?></td>
                    <td><?= htmlspecialchars($ligne['LibRobe']); ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="?id=<?= urlencode($ligne['idRobe']); ?>&action=Voir" class="btn btn-primary">Voir</a>
                            <a href="?id=<?= urlencode($ligne['idRobe']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                            <form method="post" action="../Controleur/Robe/PHP_CRUD_Robe/traitement_robe.php" style="display:inline-block;">
                                <input type="hidden" name="idRobe" value="<?= htmlspecialchars($ligne['idRobe']); ?>">
                                <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce galop ?')">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach;
        } else { ?>
            <tr>
                <td colspan="3" class="text-center">Aucune robe trouvée.</td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
        <form method="get">
        <div class="action-buttons mt-4">
            <form method="get" style="display: inline;">
                <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Pension</button>
            </form>
            <a href="../Class/PDF/class_RobePDF.php" target="_blank" class="btn btn-secondary">
                <i class="fas fa-file-pdf"></i> Exporter en PDF
            </a>
    </div>
</form>
</div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>
