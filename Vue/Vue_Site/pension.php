<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pension - Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <header class="main-header">
        <div class="logo-container">
            <img src="image/logo-haras.png" alt="Logo Le Haras des Neuilles" class="logo">
            <div class="logo-text">
                <h2>LE HARAS</h2>
                <h2>DES ROBERTOS</h2>
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

    <main class="pension-container">
        <!-- Hero Section -->
        <section class="hero-section" style="background-image: url('image/pension2.jpg');">
            <div class="hero-content">
                <h1>Pension équestre DE ROBERTO</h1>
                <p>Un cadre exceptionnel pour le bien-être de votre cheval</p>
                <a href="#pension-details" class="cta-button">Découvrir nos formules</a>
            </div>
        </section>



        <section class="pension-services">
            <h2>Nos Formules de Pension</h2>

            <div class="pension-cards">
                <div class="pension-card">
                    <div class="pension-card-header">
                        <h3>Pension Box</h3>
                        <p class="price">650€ / mois</p>
                    </div>
                    <div class="pension-card-content">
                        <ul>
                            <li>Box spacieux de 4x4m</li>
                            <li>Sortie quotidienne au paddock</li>
                            <li>2 repas par jour</li>
                            <li>Surveillance quotidienne</li>
                            <li>Accès aux installations</li>
                        </ul>
                        <button class="cta-button">En savoir plus</button>
                    </div>
                </div>

                <div class="pension-card featured">
                    <div class="pension-card-header">
                        <h3>Pension Box Premium</h3>
                        <p class="price">850€ / mois</p>
                    </div>
                    <div class="pension-card-content">
                        <ul>
                            <li>Box grand confort 4.5x4.5m</li>
                            <li>Sorties paddock individuelles</li>
                            <li>3 repas par jour</li>
                            <li>Surveillance 24/7</li>
                            <li>Accès prioritaire aux installations</li>
                            <li>Soins personnalisés</li>
                        </ul>
                        <button class="cta-button">En savoir plus</button>
                    </div>
                </div>

                <div class="pension-card">
                    <div class="pension-card-header">
                        <h3>Pension Pré</h3>
                        <p class="price">450€ / mois</p>
                    </div>
                    <div class="pension-card-content">
                        <ul>
                            <li>Pré avec abri</li>
                            <li>2 repas par jour</li>
                            <li>Surveillance quotidienne</li>
                            <li>Accès aux installations</li>
                        </ul>
                        <button class="cta-button">En savoir plus</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="installations-showcase">
            <h2>Nos Installations Premium</h2>
            <div class="installations-grid">
                <div class="installation-card">
                    <div class="installation-image">
                        <img src="../../image/maneges.jpg" alt="Manège couvert">
                        <div class="installation-overlay">
                            <span class="view-more">Explorer</span>
                        </div>
                    </div>
                    <div class="installation-info">
                        <h3>Manège Couvert</h3>
                        <ul class="features-list">
                            <li>Dimensions : 60x20m</li>
                            <li>Sol fibré de qualité</li>
                            <li>Éclairage LED</li>
                            <li>Arrosage automatique</li>
                        </ul>
                    </div>
                </div>

                <div class="installation-card">
                    <div class="installation-image">
                        <img src="../../image/carrière.jpg" alt="Carrière">
                        <div class="installation-overlay">
                            <span class="view-more">Explorer</span>
                        </div>
                    </div>
                    <div class="installation-info">
                        <h3>Carrière Olympique</h3>
                        <ul class="features-list">
                            <li>Dimensions : 80x40m</li>
                            <li>Sable de Fontainebleau</li>
                            <li>Drainage optimal</li>
                            <li>Obstacles de compétition</li>
                        </ul>
                    </div>
                </div>

                <div class="installation-card">
                    <div class="installation-image">
                        <img src="../../image/paddocks.jpeg" alt="Paddocks">
                        <div class="installation-overlay">
                            <span class="view-more">Explorer</span>
                        </div>
                    </div>
                    <div class="installation-info">
                        <h3>Paddocks & Prés</h3>
                        <ul class="features-list">
                            <li>20 hectares de prairies</li>
                            <li>Clôtures électriques</li>
                            <li>Abris dans chaque pré</li>
                            <li>Rotation des parcelles</li>
                        </ul>
                    </div>
                </div>

                <div class="installation-card">
                    <div class="installation-image">
                        <img src="../../image/soins.jpg" alt="Espace Soins">
                        <div class="installation-overlay">
                            <span class="view-more">Explorer</span>
                        </div>
                    </div>
                    <div class="installation-info">
                        <h3>Espace Soins</h3>
                        <ul class="features-list">
                            <li>Douche eau chaude/froide</li>
                            <li>Solarium</li>
                            <li>Aire de pansage</li>
                            <li>Surveillance vidéo 24/7</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="installations-features">
                <div class="feature-highlight">
                    <i class="fas fa-medal"></i>
                    <h4>Qualité Premium</h4>
                    <p>Installations haut de gamme pour le confort de votre cheval</p>
                </div>
                <div class="feature-highlight">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Sécurité Maximale</h4>
                    <p>Surveillance 24/7 et équipements sécurisés</p>
                </div>
                <div class="feature-highlight">
                    <i class="fas fa-heart"></i>
                    <h4>Bien-être Équin</h4>
                    <p>Environnement optimal pour l'épanouissement</p>
                </div>
            </div>
        </section>

        <section class="pension-contact">
            <h2>Intéressé par nos Services ?</h2>
            <p>Contactez-nous pour plus d'informations ou pour visiter nos installations</p>
            <a href="contact.html" class="cta-button">Nous Contacter</a>
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
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fa-brands fa-twitter"></i>
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