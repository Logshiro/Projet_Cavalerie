<?php
session_start();
require_once __DIR__ . '/../../Class/class_pension.php';

// Instantiate Pension class
$pensionObj = new Pension();

// Fetch all non-deleted pensions
$pensions = $pensionObj->pension_all();

// Hardcoded features for display (since no description field in pension table)
$pensionFeatures = [
    'Pension Box' => [
        'Box spacieux de 4x4m',
        'Sortie quotidienne au paddock',
        '2 repas par jour',
        'Surveillance quotidienne',
        'Accès aux installations'
    ],
    'Pension Box Premium' => [
        'Box grand confort 4.5x4.5m',
        'Sorties paddock individuelles',
        '3 repas par jour',
        'Surveillance 24/7',
        'Accès prioritaire aux installations',
        'Soins personnalisés'
    ],
    'Pension Pré' => [
        'Pré avec abri',
        '2 repas par jour',
        'Surveillance quotidienne',
        'Accès aux installations'
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pension - Haras des Neuilles</title>
    <link rel="stylesheet" href="/gestion_centre_equestre-ProjectC2/Css/css_site/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .no-pensions {
            text-align: center;
            padding: 2rem;
            color: #666;
            font-size: 1.2rem;
        }
        .no-pensions i {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }
        .pension-card, .installation-card {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .pension-card:nth-child(2), .installation-card:nth-child(2) {
            animation-delay: 0.2s;
        }
        .pension-card:nth-child(3), .installation-card:nth-child(3) {
            animation-delay: 0.4s;
        }
        .installation-card:nth-child(4) {
            animation-delay: 0.6s;
        }
    </style>
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
                <li><a href="?action=pension_site" class="active">Pension</a></li>
                <li><a href="?action=cours_site">Cours</a></li>
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

    <main class="pension-container">
        <section class="pension-hero" style="background-image: url('/gestion_centre_equestre-ProjectC2/image/pension2.jpg');">
            <div class="hero-content">
                <h1>Pension Équestre</h1>
                <p>Un cadre exceptionnel pour le bien-être de votre cheval</p>
                <a href="#pension-services" class="cta-button">Découvrir nos formules</a>
            </div>
        </section>

        <section class="pension-services" id="pension-services">
            <h2>Nos Formules de Pension</h2>
            <?php if (empty($pensions)): ?>
                <div class="no-pensions">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>Aucune formule de pension disponible pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="pension-cards">
                    <?php foreach ($pensions as $pension): ?>
                        <div class="pension-card<?php echo $pension['LibPension'] === 'Pension Box Premium' ? ' featured' : ''; ?>">
                            <div class="pension-card-header">
                                <h3><?php echo htmlspecialchars($pension['LibPension']); ?></h3>
                                <p class="price"><?php echo number_format($pension['Tarifs'], 2); ?> € / mois</p>
                            </div>
                            <div class="pension-card-content">
                                <ul>
                                    <?php
                                    $features = isset($pensionFeatures[$pension['LibPension']]) ? $pensionFeatures[$pension['LibPension']] : ['Détails non disponibles'];
                                    foreach ($features as $feature):
                                    ?>
                                        <li><?php echo htmlspecialchars($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button class="cta-button" onclick="alert('Contactez-nous pour plus d\'informations sur <?php echo htmlspecialchars($pension['LibPension']); ?> !')">En savoir plus</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="installations-showcase">
            <h2>Nos Installations Premium</h2>
            <div class="installations-grid">
                <div class="installation-card">
                    <div class="installation-image">
                        <img src="/gestion_centre_equestre-ProjectC2/image/maneges.jpg" alt="Manège couvert">
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
                        <img src="/gestion_centre_equestre-ProjectC2/image/carrière.jpg" alt="Carrière">
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
                        <img src="/gestion_centre_equestre-ProjectC2/image/paddocks.jpeg" alt="Paddocks">
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
                        <img src="/gestion_centre_equestre-ProjectC2/image/soins.jpg" alt="Espace Soins">
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

    <script>
        // Scroll animation observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in', 'visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.pension-card, .installation-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>