<?php
// Par Quentin Mitou
// include_once __DIR__ . '/../modele/fonction/conexion_v.php';

session_start();
require 'vue_header.php';

require_once __DIR__ . '/../Class/class_race.php';

// Récupération des données via les paramètres GET
$idRace = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idRace);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Races</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Races</h1>

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
        $race = new Race("", "");
        $raceData = $race->race_id($idRace);
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails de la Race</h3>
                    <p><strong>ID :</strong> <?= $raceData['idRace']; ?></p>
                    <p><strong>Nom :</strong> <?= $raceData['LibRace']; ?></p>
                </section>
            </div>
            
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $race = new Race("", "");
        $raceData = $isEditing ? $race->race_id($idRace) : null;
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Race/PHP_CRUD_Race/traitement_race.php" class="mb-4">
                <h3><?= $isEditing ? 'Modifier une Race' : 'Ajouter une Race'; ?></h3>
                <div class="form-group mb-3">
                    <label for="LibRace">Nom de la Race</label>
                    <input type="text" name="LibRace" id="LibRace" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($raceData['LibRace']) : '' ?>" required>
                    <?php if ($isEditing): ?>
                        <input type="hidden" name="idRace" value="<?= htmlspecialchars($idRace); ?>">
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
                <th>Nom Race</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $race = new Race("", "");
        $allRace = $race->race_all();

        if ($allRace && is_array($allRace)) {
            foreach ($allRace as $ligne) : ?>
                <tr>
                    <td><?= $ligne['idRace']; ?></td>
                    <td><?= htmlspecialchars($ligne['LibRace']); ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="?id=<?= urlencode($ligne['idRace']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                            <a href="?id=<?= urlencode($ligne['idRace']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                            <form method="post" action="../Controleur/Race/PHP_CRUD_Race/traitement_race.php" style="display:inline-block;">
                                <input type="hidden" name="idRace" value="<?= htmlspecialchars($ligne['idRace']); ?>">
                                <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce galop ?')">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach;
        } else { ?>
            <tr>
                <td colspan="3" class="text-center">Aucune race trouvée.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="action-buttons mt-4">
        <form method="get" style="display: inline;">
            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Pension</button>
        </form>
        <a href="../Class/PDF/class_RacePDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
        </a>
    </div>
</div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>
