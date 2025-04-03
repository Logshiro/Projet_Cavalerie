
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link rel="stylesheet" href="Css/css_site/connexion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
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

    <main class="login-container">
        <div class="login-header">
            <h1>Connexion</h1>
            <?php if(isset($_SESSION['erreur'])){
                    echo "<div class='alert alert-danger'>".$_SESSION['erreur']."</div>";
                    unset($_SESSION['erreur']);
                }
            ?>
        </div>
        <form action="index.php?action=connexion_site" method="post" class="login-form">
            <div class="form-group">
                <input type="email" id="mail" name="mail" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="cta-button">Se connecter</button>
        </form>
        <div class="login-footer">
            <p>Pas encore inscrit ? <a href="./index.php?action=inscription_site">Créer un compte</a></p>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact</h3>
                <p><i class="fas fa-map-marker-alt"></i> Route des Neuilles, 44000 Nantes</p>
                <p><i class="fas fa-phone"></i> 02 40 00 00 00</p>
                <p><i class="fas fa-envelope"></i> contact@haras-neuilles.fr</p>
            </div>
            <div class="footer-section">
                <h3>Horaires</h3>
                <p>Lundi - Samedi : 8h00 - 19h00</p>
                <p>Dimanche : 9h00 - 18h00</p>
            </div>
            <div class="social-section">
                <h3>Suivez-nous</h3>
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
        <div class="footer-bottom">
            <p>&copy; 2024 Haras des Neuilles. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>