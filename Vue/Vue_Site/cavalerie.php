<?php
session_start();
require_once 'PDO/bdd.inc.php';
    try {
        $bdd = connexionPDO();
    $req = $bdd->query('
        SELECT cavalerie.*, photo.LibPhoto, race.LibRace 
        FROM cavalerie 
        LEFT JOIN photo ON cavalerie.NumSir = photo.RefNumSir 
        LEFT JOIN race ON cavalerie.RefRace = race.idRace
        ORDER BY cavalerie.RefRace, cavalerie.NomCheval
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
    <title>Cavalerie - Haras des Neuilles</title>
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

    <main class="cavalerie-container">
        <!-- Section Hero -->
        <section class="cavalerie-hero">
            <div class="hero-content">
                <h1>Notre Cavalerie d'Exception</h1>
                <p>Découvrez nos chevaux sélectionnés avec soin pour votre passion équestre</p>
            </div>
        </section>

        <!-- Section Introduction -->
        <section class="cavalerie-intro">
            <div class="intro-content">
                <h2>Une Cavalerie de Qualité</h2>
                <p>Le Haras des Neuilles vous propose une sélection de chevaux et poneys adaptés à tous les niveaux</p>
                <div class="stats-container">
                    <div class="stat-item">
                        <span class="stat-number">30+</span>
                        <span class="stat-label">Chevaux</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Races</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Disciplines</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Filtres -->
        <section class="cavalerie-filters">
            <div class="filter-container">
                <h3>Explorer Notre Cavalerie</h3>
                <div class="filter-options">
                    <button class="filter-btn active" data-filter="all">Tous les Chevaux</button>
            
                </div>
            </div>
        </section>

        <!-- Section Chevaux -->
        <section class="cavalerie-grid" id="cavalerieGrid">
            <?php while($cheval = $req->fetch()) { ?>
            <article class="horse-card" data-category="<?php echo htmlspecialchars($cheval['RefRace']); ?>">
                <div class="horse-image">
                    <img src="../../modele/fonction/getImage.php?id=<?php echo htmlspecialchars($cheval['NumSir']); ?>" alt="<?php echo htmlspecialchars($cheval['NomCheval']); ?>">
                    <div class="horse-quick-info">
                        <span class="horse-discipline">Discipline</span>
                    </div>
                </div>
                <div class="horse-details">
                    <h4><?php echo htmlspecialchars($cheval['NomCheval']); ?></h4>
                    <p class="horse-breed">Race: <?php echo htmlspecialchars($cheval['LibRace']); ?></p>
                    <div class="horse-specs">
                        <span>Garot: <?php echo htmlspecialchars($cheval['Garot']); ?> cm</span>
                        <span>Date de Naissance: <?php echo htmlspecialchars($cheval['DateNC']); ?></span>
                    </div>
                    <button class="view-more-btn">
                        <a href="../../modele/fonction/cheval_details.php?id=<?php echo $cheval['NumSir']; ?>">En savoir plus</a>
                    </button>
                </div>
            </article>
            <?php } ?>
        </section>

        <!-- Modal Détails Cheval -->
        <div id="horseModal" class="horse-modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <div class="modal-body">
                    <!-- Contenu dynamique via JavaScript -->
                </div>
            </div>
        </div>
    </main>
    <footer class="main-footer">
    <div class="footer-content">
        <!-- Section Contact -->
        <div class="footer-section">
            <h2>Contact</h2>
            <div class="contact-info">
                <a href="#"><i class="fas fa-map-marker-alt"></i> Route des Neuilles, 44000 Nantes</a>
                <a href="tel:0240000000"><i class="fas fa-phone"></i> 02 40 00 00 00</a>
                <a href="mailto:contact@haras-neuilles.fr"><i class="fas fa-envelope"></i> contact@haras-neuilles.fr</a>
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

    <script src="/js/cavalerie.js"></script>
</body>

</html>