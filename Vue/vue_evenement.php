<?php
session_start();
require 'vue_header.php';
require_once __DIR__ . '/../Class/class_evenement.php';

// Récupération des données via les paramètres GET
$idEvenement = isset($_GET['id']) ? $_GET['id'] : '';
$isEditing = !empty($idEvenement);

// Contrôle de la visibilité des formulaires selon l'action spécifiée
$formVisible1 = isset($_GET['action']) && ($_GET['action'] === 'Voir');
$formVisible2 = isset($_GET['action']) && ($_GET['action'] === 'add' || $_GET['action'] === 'Modifier');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Événements</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_vue.css">
    <script src="../Js/jquery.min.js"></script>
    <script src="../Js/addPhotos.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Événements</h1>

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
        $evenement = new Evenement("", "", "");
        $evenementData = $evenement->evenement_id($idEvenement);
        $photos = $evenement->evenement_photo($idEvenement);
        ?>
    <main class="container">
        <div class="row">
                <section class="col-12">
                    <h3>Détails de l'Événement</h3>
                    <p><strong>ID :</strong> <?= htmlspecialchars($evenementData['idEvenement']); ?></p>
                    <p><strong>Titre :</strong> <?= htmlspecialchars($evenementData['TitreE']); ?></p>
                    <p><strong>Commentaire :</strong> <?= htmlspecialchars($evenementData['CommentaireE']); ?></p>
                    
                    <div class="row">
                        <?php foreach($photos as $photo): ?>
                            <div class="col-md-4 mb-3">             
                                <img src="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                     alt="Photo de <?= htmlspecialchars($evenementData['TitreE']); ?>" 
                                     class="img-fluid rounded"
                                     style="max-height: 300px; object-fit: cover;">
                                <p class="small text-muted mt-2">Photo de <?= htmlspecialchars($evenementData['TitreE']); ?></p>
                                
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
        $evenement = new Evenement("", "", "");
        $evenementData = $isEditing ? $evenement->evenement_id($idEvenement) : null;
        $photos = $isEditing ? $evenement->evenement_photo($idEvenement) : [];
        ?>
        <main class="container">
            <form method="post" action="../Controleur/Evenement/PHP_CRUD_Evenement/traitement_evenement.php" class="mb-4" enctype="multipart/form-data">
                <h3><?= $isEditing ? 'Modifier un Événement' : 'Ajouter un Événement'; ?></h3>

                <div class="form-group mb-3">
                    <label for="TitreE">Titre</label>
                    <input type="text" name="TitreE" id="TitreE" class="form-control"
                        value="<?= $isEditing ? htmlspecialchars($evenementData['TitreE']) : '' ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="CommentaireE">Commentaire</label>
                    <textarea name="CommentaireE" id="CommentaireE" class="form-control" required><?= $isEditing ? htmlspecialchars($evenementData['CommentaireE']) : '' ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="LibPhoto">Photos</label>
                    <input type="file" name="LibPhoto[]" id="LibPhoto" class="form-control photo-input"
                        onchange="handleFileSelect(this)" multiple accept="image/*">
                    <div id="additional-photos"></div>
                </div>

                <?php if ($isEditing): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($idEvenement); ?>">
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
                                                 alt="Photo de <?= htmlspecialchars($evenementData['TitreE']); ?>" 
                                                 class="card-img-top"
                                                 style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="<?= htmlspecialchars($photo['LibPhoto']); ?>" 
                                                       target="_blank" 
                                                       class="btn btn-sm btn-primary">
                                                        Voir en grand
                                                    </a>
                                                    <form method="post" action="../Controleur/Evenement/PHP_CRUD_Evenement/traitement_evenement.php" style="display:inline;">
                                                        <input type="hidden" name="action" value="delete_photo">
                                                        <input type="hidden" name="photo_id" value="<?= htmlspecialchars($photo['idPhoto']); ?>">
                                                        <input type="hidden" name="id" value="<?= htmlspecialchars($idEvenement); ?>">
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

    <!-- Tableau affichant les événements existants -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                        <tr>
                    <th>ID</th>
                            <th>Titre</th>
                            <th>Commentaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                $evenement = new Evenement("", "", "");
                $allEvenement = $evenement->Evenement_All();

                if ($allEvenement && is_array($allEvenement)) {
                    foreach ($allEvenement as $ligne) : ?>
                            <tr>
                            <td><?= htmlspecialchars($ligne['idEvenement']); ?></td>
                            <td><?= htmlspecialchars($ligne['TitreE']); ?></td>
                            <td><?= htmlspecialchars($ligne['CommentaireE']); ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="?id=<?= urlencode($ligne['idEvenement']); ?>&action=Voir" class="btn btn-primary btn-sm">Voir</a>
                                    <a href="?id=<?= urlencode($ligne['idEvenement']); ?>&action=Modifier" class="btn btn-warning btn-sm">Modifier</a>
                                    <form method="post" action="../Controleur/Evenement/PHP_CRUD_Evenement/traitement_evenement.php" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($ligne['idEvenement']); ?>">
                                        <button type="submit" name="action" value="Supprimer" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucun événement trouvé.</td>
                            </tr>
                <?php } ?>
                    </tbody>
                </table>
    </div>

    <div class="action-buttons mt-4">
                        <form method="get" style="display: inline;">
            <button type="submit" name="action" value="add" class="btn btn-primary">Ajouter un Événement</button>
                        </form>
        <a href="../Class/PDF/class_EvenementPDF.php" target="_blank" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exporter en PDF
                        </a>
    </div>
</div>
<script src="../Js/Js_liste_formulaire.js"></script>
</body>
</html>