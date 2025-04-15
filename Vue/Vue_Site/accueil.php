<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

    <div class="hero-section">
        <div class="hero-content">
            <h2>Bienvenue au Haras des Neuilles</h2>
            <p>Une passion équestre partagée depuis plus de 30 ans 
            <?php
            // Affichage des messages
            if (isset($_GET['message'])) {
                echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
            }
            ?></p>

            <a href="#services" class="cta-button">Découvrir nos prestations</a>
        </div>
    </div>

    <main>
        <section id="services" class="services-section">
            <h2 class="section-title">Nos Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-horse"></i>
                    <h3>Pension Complete</h3>
                    <p>Boxes spacieux, surveillance 24/7, soins quotidiens</p>
                    <a href="?action=pension_site" class="learn-more">En savoir plus</a>
                </div>
                <div class="service-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>École d'Équitation</h3>
                    <p>Cours tous niveaux, du débutant au galop 7</p>
                    <a href="?action=cours_site" class="learn-more">En savoir plus</a>
                </div>
                <div class="service-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Stages & Compétitions</h3>
                    <p>Stages vacances, préparation aux compétitions</p>
                    <a href="?action=evenement_site" class="learn-more">En savoir plus</a>
                </div>
            </div>
        </section>

        <section class="installations-section">
            <h2 class="section-title">Nos Installations</h2>
            <div class="installations-grid">
                <div class="installation-item">
                    <img src="image/maneges.jpg" alt="Manège couvert">
                    <h3>Manège Couvert</h3>
                    <p>60x20m avec sol fibré</p>
                </div>
                <div class="installation-item">
                    <img src="image/maneges_2.jpg" alt="Carrière">
                    <h3>Carrière</h3>
                    <p>80x40m en sable de Fontainebleau</p>
                </div>
                <div class="installation-item">
                    <img src="image/paddocks.jpeg" alt="Paddocks">
                    <h3>Paddocks</h3>
                    <p>20 hectares de prairies</p>
                </div>
            </div>
        </section>

        <section class="actualites-section">
            <h2 class="section-title">Actualités</h2>
            <div class="news-grid">
                <article class="news-card">
                    <img src="image/stage.jpeg" alt="Stage d'été">
                    <div class="news-content">
                        <h3>Stages Vacances d'Été 2024</h3>
                        <p>Inscriptions ouvertes pour nos stages d'été. Places limitées !</p>
                        <a href="inscription.html" class="btn-more">S'inscrire</a>
                    </div>
                </article>
                <article class="news-card">
                    <img src="image/comp.jpeg" alt="Compétition">
                    <div class="news-content">
                        <h3>Concours CSO - Mai 2024</h3>
                        <p>Prochain concours interne le 15 mai. Tous niveaux.</p>
                        <a href="competitions.html" class="btn-more">Détails</a>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <!-- Section Contact -->
            <div class="footer-section">
                <h2>Contact</h2>
                <div class="contact-info">
                    <a href="#"><i class="fas fa-map-marker-alt"></i> Route des Neuilles, 44000 Nantes</a>
                    <a href="tel:0240000000"><i class="fas fa-phone"></i> 02 40 00 00 00</a>
                    <a href="mailto:contact@haras-neuilles.fr"><i class="fas fa-envelope"></i>
                        contact@haras-neuilles.fr</a>
                </div>
            </div>

            <!-- Section Horaires -->
            <div class="footer-section">
                <h2>Horaires</h2>
                <div class="horaires-info">
                    <p>Lundi - Samedi : 8h00 - 19h00</p>
                    <p>Dimanche : 9h00 - 18h00</p>
                </div>
            </div>

            <!-- Section Suivez-nous -->
            <div class="footer-section">
                <h2>Suivez-nous</h2>
                <div class="social-links">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p>© 2024 Haras des Neuilles. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>