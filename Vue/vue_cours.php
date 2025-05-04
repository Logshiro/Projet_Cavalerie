<?php
session_start();
require 'vue_header.php';
require_once __DIR__ . '/../Class/class_cours.php';
require_once __DIR__ . '/../Class/class_inscrit.php';
require_once __DIR__ . '/../Class/class_participe.php';

// Récupération des données via les paramètres GET
$idCours = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idCours);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    <script src="../Js/jquery.min.js"></script>
    <script src="../Js/Script_cours.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Cours</h1>

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
        $cours = new Cours("", "", "", "", "", "");
        $coursData = $cours->cours_id($idCours);
        $inscrits = $cours->getCours_CavalierP($idCours);
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails du Cours</h3>
                    <p><strong>ID :</strong> <?= htmlspecialchars($coursData['idCours']); ?></p>
                    <p><strong>Libellé :</strong> <?= htmlspecialchars($coursData['Libcours']); ?></p>
                    <p><strong>Jour :</strong> <?= htmlspecialchars($coursData['jour']); ?></p>
                    <p><strong>Heure de début :</strong> <?= htmlspecialchars($coursData['HD']); ?></p>
                    <p><strong>Heure de fin :</strong> <?= htmlspecialchars($coursData['HF']); ?></p>
                    <p><strong>Galop :</strong> <?= htmlspecialchars($cours->getCours_Galop($coursData['RefGalop'])); ?></p>
                    
                    <h4 class="mt-4">Cavaliers inscrits</h4>
                    <ul class="list-group">
                        <?php foreach($inscrits as $inscrit): ?>
                            <li class="list-group-item">
                                <?= htmlspecialchars($cours->getCours_Cavalier($inscrit['RefCavalier'])); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $cours = new Cours("", "", "", "", "", "");
        $coursData = $isEditing ? $cours->cours_id($idCours) : null;
        $inscrits = $isEditing ? $cours->getCours_CavalierP($idCours) : [];
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Cours/PHP_CRUD_Cours/traitement_cours.php" class="mb-4">
                <h3><?= $isEditing ? 'Modifier un Cours' : 'Ajouter un Cours'; ?></h3>

                <div class="form-group mb-3">
                    <label for="Libcours">Libellé</label>
                    <input type="text" name="Libcours" id="Libcours" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($coursData['Libcours']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="jour">Jour</label>
                    <input type="text" name="jour" id="jour" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($coursData['jour']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="HD">Heure de début</label>
                    <input type="time" name="HD" id="HD" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($coursData['HD']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="HF">Heure de fin</label>
                    <input type="time" name="HF" id="HF" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($coursData['HF']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="RefGalop">Galop</label>
                    <input type="text" name="RefGalop" id="RefGalop" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cours->getCours_Galop($coursData['RefGalop'])) : '' ?>"
                        onkeyup="autocompletGalopI()" required>
                    <div id="nom_list_idGalop" class="list-group"></div>
                    <input type="hidden" name="idGalop" id="idGalop"
                        value="<?= $isEditing ? htmlspecialchars($coursData['RefGalop']) : '' ?>">
                </div>

                <div class="form-group mb-3" id="cavalierFields">
                    <label for="RefCavalier">Nom du cavalier</label>
                    <input type="text" id="RefCavalier" name="RefCavalier[]" class="form-control"
                        onkeyup="autocomplet_InsertCL()" required>
                    <div id="nom_list_idCLI" class="list-group"></div>
                    <input type="hidden" name="idCL[]" id="idCL">
                </div>

                <button type="button" class="btn btn-secondary mb-3" onclick="addCavalierField()">
                    Ajouter un autre cavalier
                </button>

                <?php if ($isEditing): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($idCours); ?>">
                <?php endif; ?>

                <button type="submit" name="action" value="<?= $isEditing ? 'Modifier' : 'Ajouter'; ?>" class="btn btn-primary">
                    <?= $isEditing ? 'Modifier' : 'Ajouter'; ?>
                </button>
            </form>
        </main>
    <?php endif; ?>

    <!-- Tableau affichant les cours existants -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
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
                $cours = new Cours("", "", "", "", "", "");
                $allCours = $cours->cours_all();

                if ($allCours && is_array($allCours)) {
                    foreach ($allCours as $ligne) : ?>
                        <tr>
                            <td><?= htmlspecialchars($ligne['idCours']); ?></td>
                            <td><?= htmlspecialchars($ligne['Libcours']); ?></td>
                            <td><?= htmlspecialchars($ligne['jour']); ?></td>
                            <td><?= htmlspecialchars($ligne['HD']); ?></td>
                            <td><?= htmlspecialchars($ligne['HF']); ?></td>
                            <td><?= htmlspecialchars($cours->getCours_Galop($ligne['RefGalop'])); ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="?id=<?= urlencode($ligne['idCours']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                                    <a href="?id=<?= urlencode($ligne['idCours']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                                    <form method="post" action="../Controleur/Cours/PHP_CRUD_Cours/traitement_cours.php" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($ligne['idCours']); ?>">
                                        <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                } else { ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun cours trouvé.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="action-buttons mt-4">
        <form method="get" style="display: inline;">
            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter un Cours</button>
        </form>
        <a href="../Class/PDF/class_CoursPDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
        </a>
    </div>
</div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>