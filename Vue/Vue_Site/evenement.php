<?php
session_start();
    require_once 'PDO/bdd.inc.php';
    try {
        $bdd = connexionPDO();
        $req = $bdd->query('
            SELECT evenement.*, GROUP_CONCAT(photo.idPhoto) as photo_ids, GROUP_CONCAT(photo.LibPhoto) as photo_libs 
        FROM evenement 
        LEFT JOIN photo ON evenement.idEvenement = photo.RefEvenement 
        WHERE evenement.Supprime = 0 
        GROUP BY evenement.idEvenement
        ORDER BY evenement.idEvenement DESC
    ');
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements - Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link rel="stylesheet" href="Css/css_site/evenement.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="Js/site.js/carrouselle.js" type="text/javascript"></script>
</head>

<body>
    <header class="main-header">
        <div class="logo-container">
            <img src="image/logo-haras.png" alt="Logo Le Haras des Neuilles" class="logo">
            <div class="logo-text">
                <h2>LE HARAS</h2>
                <h2>DES NEUILLES</h2>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="?action=acceuil">Accueil</a></li>
                <li><a href="?action=cavalerie_site">Cavalerie</a></li>
                <li><a href="?action=pension_site" class="active">Pension</a></li>
                <li><a href="?action=cours_site">Cours</a></li>
                <li><a href="?action=evenement_site" class="active">Événements</a></li>
                <li><a href="?action=contact_site">Contact</a></li>
                <li class="auth-buttons">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="?action=espace_personnel" class="btn-logout">espace personnel</a>
                    <?php else: ?>
                        <a href="?action=connexion_site" class="btn-login">Connexion</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <main class="evenements-container">
        <section class="hero-section" style="background-image: url('../../image/evenement.jpg');">
            <div class="hero-content">
                <h1>Nos Événements</h1>
                <p>Découvrez tous les événements à venir au Haras des Neuilles</p>
            </div>
        </section>

        <section class="evenements-grid" id="evenementsGrid">
            <?php while($evenement = $req->fetch()) { ?>
                <article class="evenement-card" data-category="<?php echo htmlspecialchars($evenement['idEvenement']); ?>">
                    <div class="evenement-image">
                        <div class="carousel">
                            <div class="carousel-container">
                                <div class="carousel-slide active">
                                    <img src="../../harasdesneuilles/gestion_centre_equestre-ProjectC2/modele/fonction/getImage2.php?id=<?php echo htmlspecialchars($evenement['idEvenement']); ?>" 
                                         alt="<?php echo htmlspecialchars($evenement['TitreE']); ?>" 
                                         onerror="this.onerror=null; this.src='../../image/default-event.jpg';">
                                </div>
                                <!-- Ajoutez d'autres slides ici si nécessaire -->
                            </div>
                        </div>
                    </div>
                    <div class="evenement-details">
                        <h3><?php echo htmlspecialchars($evenement['TitreE']); ?></h3>
                        <p class="evenement-description">
                            <?php echo htmlspecialchars($evenement['CommentaireE']); ?>
                        </p>
                        <div class="evenement-info">
                            <span><i class="fas fa-calendar"></i> Événement <?php echo htmlspecialchars($evenement['idEvenement']); ?></span>
                        </div>
                        <a href="../../harasdesneuilles/gestion_centre_equestre-ProjectC2/modele/fonction/evenement_details.php?id=<?php echo $evenement['idEvenement']; ?>" class="cta-button">En savoir plus</a>
                    </div>
                </article>
            <?php } ?>
        </section>

        <?php if($req->rowCount() == 0) { ?>
            <div class="no-events">
                <i class="fas fa-calendar-times"></i>
                <p>Aucun événement n'est prévu pour le moment.</p>
            </div>
        <?php } ?>

        <section class="newsletter-section">
            <div class="newsletter-content">
                <h2>Restez informé de nos événements</h2>
                <p>Inscrivez-vous à notre newsletter pour ne manquer aucun événement</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre adresse email" required>
                    <button type="submit" class="cta-button">S'inscrire</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h2>Contact</h2>
                <div class="contact-info">
                    <a href="#"><i class="fas fa-map-marker-alt"></i> Route des Neuilles, 44000 Nantes</a>
                    <a href="tel:0240000000"><i class="fas fa-phone"></i> 02 40 00 00 00</a>
                    <a href="mailto:contact@haras-neuilles.fr"><i class="fas fa-envelope"></i> contact@haras-neuilles.fr</a>
                </div>
            </div>

            <div class="footer-section">
                <h2>Horaires</h2>
                <div class="horaires-info">
                    <p>Lundi - Samedi : 8h00 - 19h00</p>
                    <p>Dimanche : 9h00 - 18h00</p>
                </div>
            </div>

            <div class="footer-section">
                <h2>Suivez-nous</h2>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2024 Haras des Neuilles. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>
