<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours - Haras des Neuilles</title>
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

    <main class="courses-container">
        <section class="hero-banner">
            <img src="image/cours.jpg" alt="Chevaux du haras" class="hero-image">
            <div class="hero-text">
                <h1>Nos Cours d'Équitation</h1>
                <p>Des cours adaptés à tous les niveaux, du débutant au cavalier confirmé</p>
            </div>
        </section>

        <section class="courses-offerings">
            <h2>Nos Offres de Cours</h2>

            <div class="courses-cards">
                <div class="course-card">
                    <div class="course-card-header">
                        <h3>Cours Débutant</h3>
                        <p class="price">30€ / séance</p>
                    </div>
                    <div class="course-card-content">
                        <ul>
                            <li>Initiation à l'équitation</li>
                            <li>Apprentissage des bases</li>
                            <li>Encadrement personnalisé</li>
                            <li>Groupes de 5 cavaliers max</li>
                        </ul>
                        <button class="cta-button">En savoir plus</button>
                    </div>
                </div>

                <div class="course-card featured">
                    <div class="course-card-header">
                        <h3>Cours Intermédiaire</h3>
                        <p class="price">40€ / séance</p>
                    </div>
                    <div class="course-card-content">
                        <ul>
                            <li>Perfectionnement des techniques</li>
                            <li>Travail sur le plat et à l'obstacle</li>
                            <li>Groupes de 4 cavaliers max</li>
                            <li>Suivi personnalisé</li>
                        </ul>
                        <button class="cta-button">En savoir plus</button>
                    </div>
                </div>

                <div class="course-card">
                    <div class="course-card-header">
                        <h3>Cours Avancé</h3>
                        <p class="price">50€ / séance</p>
                    </div>
                    <div class="course-card-content">
                        <ul>
                            <li>Préparation aux compétitions</li>
                            <li>Entraînement intensif</li>
                            <li>Coaching individuel</li>
                            <li>Groupes de 3 cavaliers max</li>
                        </ul>
                        <button class="cta-button">En savoir plus</button>
                    </div>
                </div>
            </div>
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
                    <h3>Résultats Garanties</h3>
                    <p>Des progrès visibles dès les premières séances</p>
                </div>
            </div>
        </section>

        <section class="courses-contact">
            <h2>Prêt à Commencer ?</h2>
            <p>Contactez-nous pour réserver votre première séance ou pour plus d'informations</p>
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