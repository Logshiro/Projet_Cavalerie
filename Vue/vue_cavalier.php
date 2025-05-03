<?php
// Par Quentin Mitou
session_start();
require "vue_header.php";
// Modifier le chemin pour utiliser le chemin absolu depuis la racine du projet
require_once __DIR__ . '/../Class/class_cavalier.php';

$idCavalier = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idCavalier);

$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cavaliers</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    <script src="../Js/jquery.min.js"></script>
    <script src="../Js/Script_cavalier.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Cavaliers</h1>

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
        $cavalier = new Cavalier("","","","","","","","","","","","","","");
        $cavalierData = $cavalier->cavalier_id($idCavalier);
        ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h3>Détails du Cavalier</h3>
                    <p><strong>ID :</strong> <?= htmlspecialchars($cavalierData['idCavalier']); ?></p>
                    <p><strong>Numéro de Licence :</strong> <?= htmlspecialchars($cavalierData['Numlicence']); ?></p>
                    <p><strong>Nom :</strong> <?= htmlspecialchars($cavalierData['NomCavalier']); ?></p>
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($cavalierData['PrenomCavalier']); ?></p>
                    <p><strong>Date de Naissance :</strong> <?= htmlspecialchars($cavalierData['DateNaissanceCavalier']); ?></p>
                    <p><strong>Galop :</strong> <?= htmlspecialchars($cavalier->getCavalierRefG($cavalierData['RefG'])); ?></p>
                    <p><strong>Responsable :</strong> <?= htmlspecialchars($cavalierData['NomResponsable'] . ' ' . $cavalierData['PreNomResponsable']); ?></p>
                    <p><strong>Téléphone :</strong> <?= htmlspecialchars($cavalierData['TelResponsable']); ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($cavalierData['MailResponsable']); ?></p>
                    <p><strong>Commune :</strong> <?= htmlspecialchars($cavalierData['Nomcommune']); ?></p>
                    <p><strong>Assurance :</strong> <?= htmlspecialchars($cavalierData['Assurance']); ?></p>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $cavalier = new Cavalier("","","","","","","","","","","","","","");
        $cavalierData = $isEditing ? $cavalier->cavalier_id($idCavalier) : null;
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Cavalier/PHP_CRUD_Cavalier/traitement_cavalier.php" class="mb-4" id="cavalierForm">
                <h3><?= $isEditing ? 'Modifier un Cavalier' : 'Ajouter un Cavalier'; ?></h3>

                <div class="form-group mb-3">
                    <label for="Numlicence">Numéro de Licence</label>
                    <input type="text" name="Numlicence" id="Numlicence" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['Numlicence']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="NomCavalier">Nom</label>
                    <input type="text" name="NomCavalier" id="NomCavalier" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['NomCavalier']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="PrenomCavalier">Prénom</label>
                    <input type="text" name="PrenomCavalier" id="PrenomCavalier" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['PrenomCavalier']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="DateNaissanceCavalier">Date de Naissance</label>
                    <input type="<?= $isEditing ? "text" : "date" ?>" name="DateNaissanceCavalier" id="DateNaissanceCavalier" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['DateNaissanceCavalier']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="RefG">Galop</label>
                    <input type="text" name="RefG" id="RefG" class="form-control" 
                        value="<?= $isEditing ? htmlspecialchars($cavalier->getCavalierRefG($cavalierData['RefG'])) : '' ?>" 
                        onkeyup="autocompletGalop()" required>
                    <div id="nom_list_idG" class="list-group"></div>
                    <input type="hidden" name="idG" id="idG" 
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['RefG']) : '' ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="NomResponsable">Nom du Responsable</label>
                    <input type="text" name="NomResponsable" id="NomResponsable" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['NomResponsable']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="PreNomResponsable">Prénom du Responsable</label>
                    <input type="text" name="PreNomResponsable" id="PreNomResponsable" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['PreNomResponsable']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="TelResponsable">Téléphone</label>
                    <input type="tel" name="TelResponsable" id="TelResponsable" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['TelResponsable']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="MailResponsable">Email</label>
                    <input type="email" name="MailResponsable" id="MailResponsable" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['MailResponsable']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="Nomcommune">Commune</label>
                    <input type="text" name="Nomcommune" id="Nomcommune" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['Nomcommune']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="Assurance">Assurance</label>
                    <input type="text" name="Assurance" id="Assurance" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalierData['Assurance']) : '' ?>" required>
                </div>

                <?php if ($isEditing): ?>
                    <input type="hidden" name="idCavalier" value="<?= htmlspecialchars($idCavalier); ?>">
                <?php endif; ?>

                <button type="submit" name="action" value="<?= $isEditing ? 'Modifier' : 'Ajouter'; ?>" class="btn btn-primary">
                    <?= $isEditing ? 'Modifier' : 'Ajouter'; ?>
                </button>
            </form>
        </main>
    <?php endif; ?>

    <!-- Tableau affichant les cavaliers existants -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Numéro de Licence</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Galop</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $cavalier = new Cavalier("","","","","","","","","","","","","","");
            $allCavalier = $cavalier->cavalier_all();

            if ($allCavalier && is_array($allCavalier)) {
                foreach ($allCavalier as $ligne) : ?>
                    <tr>
                        <td><?= htmlspecialchars($ligne['idCavalier']); ?></td>
                        <td><?= htmlspecialchars($ligne['Numlicence']); ?></td>
                        <td><?= htmlspecialchars($ligne['NomCavalier']); ?></td>
                        <td><?= htmlspecialchars($ligne['PrenomCavalier']); ?></td>
                        <td><?= htmlspecialchars($ligne['DateNaissanceCavalier']); ?></td>
                        <td><?= htmlspecialchars($cavalier->getCavalierRefG($ligne['RefG'])); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="?id=<?= urlencode($ligne['idCavalier']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                                <a href="?id=<?= urlencode($ligne['idCavalier']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                                <form method="post" action="../Controleur/Cavalier/PHP_CRUD_Cavalier/traitement_cavalier.php" style="display:inline-block;">
                                    <input type="hidden" name="idCavalier" value="<?= htmlspecialchars($ligne['idCavalier']); ?>">
                                    <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cavalier ?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;
            } else { ?>
                <tr>
                    <td colspan="7" class="text-center">Aucun cavalier trouvé.</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="action-buttons mt-4">
        <form method="get" style="display: inline;">
            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter un Cavalier</button>
        </form>
        <a href="../Class/PDF/class_CavalierPDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
        </a>
    </div>
</div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>
