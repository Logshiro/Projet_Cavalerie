<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=crud;charset=utf8', 'root', 'root');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $req = $bdd->prepare('
            SELECT evenement.*, photo.LibPhoto 
            FROM evenement 
            LEFT JOIN photo ON evenement.idEvenement = photo.RefEvenement 
            WHERE evenement.idEvenement = ? AND evenement.Supprime = 0
        ');
        $req->execute([$id]);
        $evenement = $req->fetch();
    } else {
        die('Événement non trouvé.');
    }
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($evenement['TitreE']); ?> - Haras des Neuilles</title>
    <link rel="stylesheet" href="../../Css/css_site/styles.css">
    <link rel="stylesheet" href="../../Css/css_site/evenement_details.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <header class="main-header">
        <!-- Même header que evenement.php -->
    </header>

    <main class="evenement-details-container">
        <section class="hero-section" style="background-image: url('../../image/evenements/<?php echo htmlspecialchars($evenement['LibPhoto'] ?? 'default-event.jpg'); ?>');">
            <div class="hero-content">
                <h1><?php echo htmlspecialchars($evenement['TitreE']); ?></h1>
            </div>
        </section>

        <section class="evenement-content">
            <div class="evenement-info-grid">
                <div class="evenement-main-info">
                    <div class="evenement-description">
                        <h2>Description de l'événement</h2>
                        <p><?php echo nl2br(htmlspecialchars($evenement['CommentaireE'])); ?></p>
                    </div>
                    
                    <div class="evenement-details">
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span>Événement N°<?php echo htmlspecialchars($evenement['idEvenement']); ?></span>
                             <img src="../../modele/fonction/getImage2.php?id=<?php echo htmlspecialchars($evenement['idEvenement']); ?>">
                        </div>
                    </div>
                </div>

                <div class="evenement-image-gallery">
                    <?php if($evenement['LibPhoto']): ?>
                        <img src="../../image/evenements/<?php echo htmlspecialchars($evenement['LibPhoto']); ?>" 
                             alt="<?php echo htmlspecialchars($evenement['TitreE']); ?>"
                             class="main-image">
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <h2>Intéressé par cet événement ?</h2>
            <p>Contactez-nous pour plus d'informations ou pour vous inscrire</p>
            <a href="contact.html" class="cta-button">Nous contacter</a>
        </section>
    </main>

    <footer class="main-footer">
        <!-- Même footer que evenement.php -->
    </footer>
</body>

</html>