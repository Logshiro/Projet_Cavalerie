<?php
session_start();
require 'vue_header.php';
require_once __DIR__ . '/../Class/class_inscrit.php';

// Récupération des données via les paramètres GET
$idCavalier = isset($_GET['id1']) ? $_GET['id1'] : '';
$idCours = isset($_GET['id2']) ? $_GET['id2'] : '';
$isEditing = !empty($idCavalier) && !empty($idCours);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Inscriptions</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    <script src="../Js/jquery.min.js"></script>
    <script src="../Js/Script_inscrit.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Inscriptions</h1>

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
        $inscrit = new Inscrit("", "");
        $inscritData = $inscrit->inscrit_id($idCavalier, $idCours);
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails de l'Inscription</h3>
                    <p><strong>Cavalier :</strong> <?= htmlspecialchars($inscrit->getCavalierInscrit($inscritData['RefCavalier'])); ?></p>
                    <p><strong>Cours :</strong> <?= htmlspecialchars($inscrit->getCoursInscrit($inscritData['RefCours'])); ?></p>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $inscrit = new Inscrit("", "");
        $inscritData = $isEditing ? $inscrit->inscrit_id($idCavalier, $idCours) : null;
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Inscrit/PHP_CRUD_Inscrit/traitement_inscrit.php" class="mb-4">
                <h3><?= $isEditing ? 'Modifier une Inscription' : 'Ajouter une Inscription'; ?></h3>
                <div class="form-group mb-3">
                    <label for="RefCavalier">Cavalier</label>
                    <input type="text" name="RefCavalier" id="RefCavalier" class="form-control" 
                        value="<?= $isEditing ? htmlspecialchars($inscrit->getCavalierInscrit($inscritData['RefCavalier'])) : '' ?>" 
                        onkeyup="autocompletCavalierE()" required>
                    <div id="nom_list_idCavalierE" class="list-group"></div>
                    <input type="hidden" name="idCL" id="idCavalier" 
                        value="<?= $isEditing ? htmlspecialchars($inscritData['RefCavalier']) : '' ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="RefCours">Cours</label>
                    <input type="text" name="RefCours" id="RefCours" class="form-control" 
                        value="<?= $isEditing ? htmlspecialchars($inscrit->getCoursInscrit($inscritData['RefCours'])) : '' ?>" 
                        onkeyup="autocompletCoursE()" required>
                    <div id="nom_list_idCoursE" class="list-group"></div>
                    <input type="hidden" name="idCours" id="idCours" 
                        value="<?= $isEditing ? htmlspecialchars($inscritData['RefCours']) : '' ?>">
                </div>

                <?php if ($isEditing): ?>
                    <input type="hidden" name="idCavalier_old" value="<?= htmlspecialchars($idCavalier); ?>">
                    <input type="hidden" name="idCours_old" value="<?= htmlspecialchars($idCours); ?>">
                <?php endif; ?>
                <button type="submit" name="action" value="<?= $isEditing ? 'Modifier' : 'Ajouter'; ?>" class="btn btn-primary">
                    <?= $isEditing ? 'Modifier' : 'Ajouter'; ?>
                </button>
            </form>
        </main>
    <?php endif; ?>

    <!-- Tableau affichant les inscriptions existantes -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Cavalier</th>
                    <th>Cours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $inscrit = new Inscrit("", "");
            $allInscrit = $inscrit->inscrit_all();

            if ($allInscrit && is_array($allInscrit)) {
                foreach ($allInscrit as $ligne) : ?>
                    <tr>
                        <td><?= htmlspecialchars($inscrit->getCavalierInscrit($ligne['RefCavalier'])); ?></td>
                        <td><?= htmlspecialchars($inscrit->getCoursInscrit($ligne['RefCours'])); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="?id1=<?= urlencode($ligne['RefCavalier']); ?>&id2=<?= urlencode($ligne['RefCours']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                                <a href="?id1=<?= urlencode($ligne['RefCavalier']); ?>&id2=<?= urlencode($ligne['RefCours']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                                <form method="post" action="../Controleur/Inscrit/PHP_CRUD_Inscrit/traitement_inscrit.php" style="display:inline-block;">
                                    <input type="hidden" name="idCavalier" value="<?= htmlspecialchars($ligne['RefCavalier']); ?>">
                                    <input type="hidden" name="idCours" value="<?= htmlspecialchars($ligne['RefCours']); ?>">
                                    <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription ?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;
            } else { ?>
                <tr>
                    <td colspan="3" class="text-center">Aucune inscription trouvée.</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="action-buttons mt-4">
        <form method="get" style="display: inline;">
            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Inscription</button>
        </form>
        <a href="../Class/PDF/class_InscritPDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
        </a>
    </div>
</div>
<script src="../Js/jquery.min.js"></script>
<script src="../Js/Script_inscrit.js"></script>
</body>
</html>