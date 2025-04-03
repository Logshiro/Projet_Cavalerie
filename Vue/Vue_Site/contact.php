<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link rel="stylesheet" href="Css/css_site/contact.css">
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

    <main>
        <section class="contact-hero">
            <h1>Contactez-nous</h1>
            <p>Nous sommes à votre écoute pour toute question</p>
        </section>

        <section class="contact-form">
            <h2>Contactez-nous</h2>
            <form action="#" method="post" id="contactForm">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder=" " required>
                    <label for="name">Votre Nom</label>
                    <span class="error-message">Veuillez entrer votre nom</span>
                </div>

                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder=" " required>
                    <label for="email">Votre Email</label>
                    <span class="error-message">Veuillez entrer un email valide</span>
                </div>

                <div class="form-group">
                    <input type="text" id="subject" name="subject" placeholder=" " required>
                    <label for="subject">Sujet</label>
                    <span class="error-message">Veuillez entrer un sujet</span>
                </div>

                <div class="form-group">
                    <textarea id="message" name="message" rows="6" placeholder=" " required></textarea>
                    <label for="message">Votre Message</label>
                    <span class="error-message">Veuillez entrer votre message</span>
                </div>

                <button type="submit" class="cta-button">
                    Envoyer le message
                </button>
            </form>
        </section>

        <section class="location-map">
            <h2>Notre Localisation</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9999999999995!2d2.294481315674927!3d48.85884407928744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fdfdfdfdfdf%3A0x8e8e8e8e8e8e8e8e!2sEiffel%20Tower!5e0!3m2!1sen!2sfr!4v1616161616161!5m2!1sen!2sfr"
                    allowfullscreen="" loading="lazy"></iframe>
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