<?php
session_start();
require_once __DIR__ . '/../../Class/class_cours.php';
require_once __DIR__ . '/../../PDO/bdd.inc.php';

// Instantiate Cours class
$Cours = new Cours(0, "", "", "", "", 0);

// Fetch all non-deleted courses
$courses = $Cours->Cours_All();

// Debug: Log courses
error_log("Courses fetched: " . print_r($courses, true));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours - Haras des Neuilles</title>
    <link rel="stylesheet" href="/gestion_centre_equestre-ProjectC2/Css/css_site/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    <header class="main-header">
        <div class="logo-container">
            <img src="/gestion_centre_equestre-ProjectC2/image/logo-haras.png" alt="Logo Le Haras des Neuilles" class="logo">
            <div class="logo-text">
                <h2>LE HARAS</h2>
                <h2>DES NEUILLES</h2>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="?action=accueil">Accueil</a></li>
                <li><a href="?action=cavalerie_site">Cavalerie</a></li>
                <li><a href="?action=pension_site">Pension</a></li>
                <li><a href="?action=cours_site" class="active">Cours</a></li>
                <li><a href="?action=evenement_site">Événements</a></li>
                <li><a href="?action=contact_site">Contact</a></li>
                <li class="auth-buttons">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="?action=espace_personnel" class="btn-logout">Espace personnel</a>
                    <?php else: ?>
                        <a href="?action=connexion_site" class="btn-login">Connexion</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <main class="courses-container">
        <section class="hero-banner">
            <img src="/gestion_centre_equestre-ProjectC2/image/cours.jpg" alt="Chevaux du haras" class="hero-image">
            <div class="hero-text">
                <h1>Nos Cours d'Équitation</h1>
                <p>Des cours adaptés à tous les niveaux, du débutant au cavalier confirmé</p>
            </div>
        </section>

        <section class="courses-offerings">
            <h2>Nos Offres de Cours</h2>
            <?php if (empty($courses)): ?>
                <div class="no-courses">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>Aucun cours disponible pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="courses-cards">
                    <?php foreach ($courses as $course): ?>
                        <div class="course-card">
                            <div class="course-card-header">
                                <h3><?php echo htmlspecialchars($course['Libcours']); ?></h3>
                            </div>
                            <div class="course-card-content">
                                <div class="course-info">
                                    <span><i class="fas fa-calendar-day"></i> Jour: <?php echo htmlspecialchars($course['jour']); ?></span>
                                    <span><i class="fas fa-clock"></i> Horaires: <?php echo htmlspecialchars($course['HD'] . ' - ' . $course['HF']); ?></span>
                                    <span><i class="fas fa-star"></i> Niveau: <?php echo htmlspecialchars($Cours->getCours_Galop($course['RefGalop'])); ?></span>
                                </div>
                                <button class="cta-button">En savoir plus</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="courses-features">
            <h2>Pourquoi Choisir Nos Cours ?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>Instructeurs Certifiés</h3>
                    <p>Des professionnels passionnés et expérimentés</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-horse-head"></i>
                    <h3>Chevaux Bien Dressés</h3>
                    <p>Des montures adaptées à chaque niveau</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-award"></i>
                    <h3>Résultats Garantis</h3>
                    <p>Des progrès visibles dès les premières séances</p>
                </div>
            </div>
        </section>

        <section class="courses-contact">
            <h2>Prêt à Commencer ?</h2>
            <p>Contactez-nous pour réserver votre première séance ou pour plus d'informations</p>
            <a href="?action=contact_site" class="cta-button">Nous Contacter</a>
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