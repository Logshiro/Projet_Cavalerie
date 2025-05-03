<?php
session_start();
require 'vue_header.php';

require_once __DIR__ . '/../Class/class_pension.php';
require_once __DIR__ . '/../Class/class_Prend.php';

// Récupération des données via les paramètres GET
$idPension = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idPension);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Pensions</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    <script src="../Js/jquery.min.js"></script>
    <script src="../Js/Script_pension.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Pensions</h1>

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
        $pension = new Pension("", "", "", "", "", "", "");
        $pensionData = $pension->pension_id($idPension);
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails de la Pension</h3>
                    <p><strong>ID :</strong> <?= htmlspecialchars($pensionData['idPension']); ?></p>
                    <p><strong>Nom :</strong> <?= htmlspecialchars($pensionData['LibPension']); ?></p>
                    <p><strong>Tarifs :</strong> <?= htmlspecialchars($pensionData['Tarifs']); ?> €</p>
                    <p><strong>Date Début :</strong> <?= htmlspecialchars($pensionData['DateDebutP']); ?></p>
                    <p><strong>Date Fin :</strong> <?= htmlspecialchars($pensionData['DateFinP']); ?></p>
                    <p><strong>Cheval :</strong> <?= htmlspecialchars($pension->getPensionCavalerie($pensionData['RefNumSir'])); ?></p>
                    <p><strong>Cavalier :</strong> <?= htmlspecialchars($pension->getpensionCavalier($pensionData['RefCavalier'])); ?></p>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $pension = new Pension("", "", "", "", "", "", "");
        $pensionData = $isEditing ? $pension->pension_id($idPension) : null;
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Pension/PHP_CRUD_Pension/traitement_pension.php" class="mb-4" id="pensionForm">
                <h3><?= $isEditing ? 'Modifier une Pension' : 'Ajouter une Pension'; ?></h3>

                        <div class="form-group mb-3">
                            <label for="LibPension">Nom de la Pension</label>
                            <input type="text" name="LibPension" id="LibPension" class="form-control"
                                value="<?= $isEditing ? htmlspecialchars($pensionData['LibPension']) : '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Tarifs">Tarifs (€)</label>
                            <input type="number" name="Tarifs" id="Tarifs" class="form-control"
                                value="<?= $isEditing ? htmlspecialchars($pensionData['Tarifs']) : '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="DateDebutP">Date Début</label>
                            <input type="<?= $isEditing ? "text" : "date" ?>" name="DateDebutP" id="DateDebutP" class="form-control"
                                value="<?= $isEditing ? htmlspecialchars($pensionData['DateDebutP']) : '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="DateFinP">Date Fin</label>
                            <input type="<?= $isEditing ? "text" : "date" ?>" name="DateFinP" id="DateFinP" class="form-control"
                                value="<?= $isEditing ? htmlspecialchars($pensionData['DateFinP']) : '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="RefNumSir">Cheval</label>
                            <input type="text" name="RefNumSir" id="RefNumSir" class="form-control" 
                                value="<?= $isEditing ? htmlspecialchars($pension->getPensionCavalerie($pensionData['RefNumSir'])) : '' ?>" 
                                onkeyup="autocompletCa()" required>
                            <div id="nom_list_idCa" class="list-group"></div>
                            <input type="hidden" name="idSir" id="idSir" 
                                value="<?= $isEditing ? htmlspecialchars($pensionData['RefNumSir']) : '' ?>">
                        </div>
                        
                        <!-- Zone des cavaliers -->
                        <div id="cavalierFields">
                            <div class="form-group mb-3">
                                <label>Cavalier</label>
                                <input type="text" name="RefCavalier[]" id="RefCavalier" class="form-control" 
                                    value="<?= $isEditing ? htmlspecialchars($pension->getpensionCavalier($pensionData['RefCavalier'])) : '' ?>" 
                                    onkeyup="autocomplet_InsertCL()" required>
                                <div id="nom_list_idCLI" class="list-group"></div>
                                <input type="hidden" name="idCL[]" id="idCL" 
                                    value="<?= $isEditing ? htmlspecialchars($pensionData['RefCavalier']) : '' ?>">
                            </div>
                        </div>

                        <?php if (!$isEditing): ?>
                        <button type="button" class="btn btn-secondary mb-3" onclick="addCavalierField()">Ajouter un autre cavalier</button>
                        <?php endif; ?>

                        <?php if ($isEditing): ?>
                            <input type="hidden" name="idPension" value="<?= htmlspecialchars($idPension); ?>">
                        <?php endif; ?>
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
                    <th>Nom Pension</th>
                    <th>Tarifs</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Cheval</th>
                    <th>Cavalier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $pension = new Pension("", "", "", "", "", "", "");
            $allPension = $pension->pension_all();

            if ($allPension && is_array($allPension)) {
                foreach ($allPension as $ligne) : ?>
                    <tr>
                        <td><?= htmlspecialchars($ligne['idPension']); ?></td>
                        <td><?= htmlspecialchars($ligne['LibPension']); ?></td>
                        <td><?= htmlspecialchars($ligne['Tarifs']); ?> €</td>
                        <td><?= htmlspecialchars($ligne['DateDebutP']); ?></td>
                        <td><?= htmlspecialchars($ligne['DateFinP']); ?></td>
                        <td><?= htmlspecialchars($pension->getPensionCavalerie($ligne['RefNumSir'])); ?></td>
                        <td><?= htmlspecialchars($pension->getpensionCavalier($ligne['RefCavalier'])); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="?id=<?= urlencode($ligne['idPension']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                                <a href="?id=<?= urlencode($ligne['idPension']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                                <form method="post" action="../Controleur/Pension/PHP_CRUD_Pension/traitement_pension.php" style="display:inline-block;">
                                    <input type="hidden" name="idPension" value="<?= htmlspecialchars($ligne['idPension']); ?>">
                                    <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pension ?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;
            } else { ?>
                <tr>
                    <td colspan="8" class="text-center">Aucune pension trouvée.</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="action-buttons mt-4">
        <form method="get" style="display: inline;">
            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Pension</button>
        </form>
        <a href="../Class/PDF/class_PensionPDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
        </a>
    </div>
</div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>