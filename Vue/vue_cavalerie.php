<?php
session_start();
require 'vue_header.php';
require_once __DIR__ . '/../Class/class_cavalerie.php';

// Récupération des données via les paramètres GET
$idCavalerie = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idCavalerie);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cavaleries</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    <script src="../Js/jquery.min.js"></script>
    <script src="../Js/Script_cavalerie.js"></script>
    <script src="../Js/addPhotos.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Cavaleries</h1>

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
        $cavalerie = new Cavalerie("", "", "", "", "", "");
        $cavalerieData = $cavalerie->cavalerie_id($idCavalerie);
        $photos = $cavalerie->cavalerie_photo($idCavalerie);
        ?>
    <main class="container">
        <div class="row">
            <section class="col-12">
                    <h3>Détails de la Cavalerie</h3>
                    <p><strong>ID :</strong> <?= htmlspecialchars($cavalerieData['NumSir']); ?></p>
                    <p><strong>Nom :</strong> <?= htmlspecialchars($cavalerieData['NomCheval']); ?></p>
                    <p><strong>Date de naissance :</strong> <?= htmlspecialchars($cavalerieData['DateNC']); ?></p>
                    <p><strong>Garot :</strong> <?= htmlspecialchars($cavalerieData['Garot']); ?></p>
                    <p><strong>Race :</strong> <?= htmlspecialchars($cavalerie->getCavalerieRace($cavalerieData['RefRace'])); ?></p>
                    <p><strong>Robe :</strong> <?= htmlspecialchars($cavalerie->getCavalerieRobe($cavalerieData['RefRobe'])); ?></p>
                    
                    <div class="row">
                        <?php foreach($photos as $photo): ?>
                            <div class="col-md-4 mb-3">             
                                <img src="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                     alt="Photo de <?= htmlspecialchars($cavalerieData['NomCheval']); ?>" 
                                     class="img-fluid rounded"
                                     style="max-height: 300px; object-fit: cover;">
                                <p class="small text-muted mt-2">Photo de <?= htmlspecialchars($cavalerieData['NomCheval']); ?></p>
                                
                                <a href="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                   target="_blank" 
                                   class="btn btn-sm btn-primary">
                                    Voir en grand
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </main>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de modification -->
    <?php if ($formVisible2):      
        $cavalerie = new Cavalerie("", "", "", "", "", "");
        $cavalerieData = $isEditing ? $cavalerie->cavalerie_id($idCavalerie) : null;
        $photos = $isEditing ? $cavalerie->cavalerie_photo($idCavalerie) : [];
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Cavalerie/PHP_CRUD_Cavalerie/traitement_cavalerie.php" class="mb-4" enctype="multipart/form-data">
                <h3><?= $isEditing ? 'Modifier une Cavalerie' : 'Ajouter une Cavalerie'; ?></h3>

                <div class="form-group mb-3">
                    <label for="NomCheval">Nom du Cheval</label>
                    <input type="text" name="NomCheval" id="NomCheval" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalerieData['NomCheval']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="DateNC">Date de naissance</label>
                    <input type="<?= $isEditing ? "text" : "date" ?>" name="DateNC" id="DateNC" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalerieData['DateNC']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="Garot">Garot</label>
                    <input type="text" name="Garot" id="Garot" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalerieData['Garot']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="RefRace">Race</label>
                    <input type="text" name="RefRace" id="RefRace" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalerie->getCavalerieRace($cavalerieData['RefRace'])) : '' ?>"
                        onkeyup="autocompletRace()" required>
                    <div id="nom_list_idRace" class="list-group"></div>
                    <input type="hidden" name="idRace" id="idRace"
                        value="<?= $isEditing ? htmlspecialchars($cavalerieData['RefRace']) : '' ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="RefRobe">Robe</label>
                    <input type="text" name="RefRobe" id="RefRobe" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($cavalerie->getCavalerieRobe($cavalerieData['RefRobe'])) : '' ?>"
                        onkeyup="autocompletRobe()" required>
                    <div id="nom_list_idRobe" class="list-group"></div>
                    <input type="hidden" name="idRobe" id="idRobe"
                        value="<?= $isEditing ? htmlspecialchars($cavalerieData['RefRobe']) : '' ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="LibPhoto">Photos</label>
                    <input type="file" name="LibPhoto[]" id="LibPhoto" class="form-control photo-input"
                        onchange="handleFileSelect(this)" multiple accept="image/*">
                    <div id="additional-photos"></div>
                </div>

                <?php if ($isEditing): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($idCavalerie); ?>">
                <?php endif; ?>

                <button type="submit" name="action" value="<?= $isEditing ? 'Modifier' : 'Ajouter'; ?>" class="btn btn-primary">
                    <?= $isEditing ? 'Modifier' : 'Ajouter'; ?>
                </button>
            </form>
                <?php if ($isEditing && !empty($photos)): ?>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Photos existantes</h4>
                            <div class="row">
                                <?php foreach($photos as $photo): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                                 alt="Photo de <?= htmlspecialchars($cavalerieData['NomCheval']); ?>" 
                                                 class="card-img-top"
                                                 style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                                       target="_blank" 
                                                       class="btn btn-sm btn-primary">
                                                        Voir en grand
                                                    </a>
                                                    <form method="post" action="../Controleur/Cavalerie/PHP_CRUD_Cavalerie/traitement_cavalerie.php" style="display:inline;">
                                                        <input type="hidden" name="action" value="delete_photo">
                                                        <input type="hidden" name="photo_id" value="<?= htmlspecialchars($photo['idPhoto']); ?>">
                                                        <input type="hidden" name="id" value="<?= htmlspecialchars($idCavalerie); ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?')">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
        </main>
    <?php endif; ?>

    <!-- Tableau affichant les cavaleries existantes -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
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
            $cavalerie = new Cavalerie("", "", "", "", "", "");
            $allCavalerie = $cavalerie->cavalerie_all();

            if ($allCavalerie && is_array($allCavalerie)) {
                foreach ($allCavalerie as $ligne) : ?>
                    <tr>
                        <td><?= htmlspecialchars($ligne['NumSir']); ?></td>
                        <td><?= htmlspecialchars($ligne['NomCheval']); ?></td>
                        <td><?= htmlspecialchars($ligne['DateNC']); ?></td>
                        <td><?= htmlspecialchars($ligne['Garot']); ?></td>
                        <td><?= htmlspecialchars($cavalerie->getCavalerieRace($ligne['RefRace'])); ?></td>
                        <td><?= htmlspecialchars($cavalerie->getCavalerieRobe($ligne['RefRobe'])); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="?id=<?= urlencode($ligne['NumSir']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                                <a href="?id=<?= urlencode($ligne['NumSir']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                                <form method="post" action="../Controleur/Cavalerie/PHP_CRUD_Cavalerie/traitement_cavalerie.php" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($ligne['NumSir']); ?>">
                                    <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette cavalerie ?')">Supprimer</button>
                                        </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;
            } else { ?>
                <tr>
                    <td colspan="7" class="text-center">Aucune cavalerie trouvée.</td>
                                </tr>
            <?php } ?>
                        </tbody>
                    </table>
    </div>

    <div class="action-buttons mt-4">
                        <form method="get" style="display: inline;">
                            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter une Cavalerie</button>
                        </form>
        <a href="../Class/PDF/class_CavaleriePDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
                        </a>
                    </div>
        </div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>

