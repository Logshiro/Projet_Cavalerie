<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=crud;charset=utf8', 'root', 'root');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $req = $bdd->prepare('
            SELECT cavalerie.*, photo.LibPhoto, race.LibRace 
            FROM cavalerie 
            LEFT JOIN photo ON cavalerie.NumSir = photo.RefNumSir 
            LEFT JOIN race ON cavalerie.RefRace = race.idRace 
            WHERE cavalerie.NumSir = ?
        ');
        $req->execute([$id]);
        $cheval = $req->fetch();
    } else {
        die('Cheval non trouvé.');
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
    <title><?php echo htmlspecialchars($cheval['NomCheval']); ?> - Détails</title>
    <link rel="stylesheet" href="../../Css/css_site/cheval_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="logo-container">
            <img src="../../image/logo-haras.png" alt="Logo Le Haras des Neuilles" class="logo">
            <div class="logo-text">
                <h1>LE HARAS</h1>
                <h2 class="subtitle">DES NEUILLES</h2>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="../../Vue/vue_site/accueil.html">Accueil</a></li>
                <li><a href="../../Vue/vue_site/cavalerie.php" class="active">Cavalerie</a></li>
                <li><a href="../../Vue/vue_site/pension.html">Pension</a></li>
                <li><a href="../../Vue/vue_site/cours.html">Cours</a></li>
                <li><a href="../../Vue/vue_site/contact.html">Contact</a></li>
                <li class="auth-buttons">
                    <a href="../../Vue/vue_site/connexion.html" class="btn-login">Connexion</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if ($cheval) { ?>
            <div class="cheval-details">
                <div class="breadcrumb">
                    <a href="../../Vue/vue_site/accueil.html">Accueil</a> >
                    <a href="../../Vue/vue_site/cavalerie.php">Cavalerie</a> >
                    <span><?php echo htmlspecialchars($cheval['NomCheval']); ?></span>
                </div>

                <div class="cheval-header">
                    <h1><?php echo htmlspecialchars($cheval['NomCheval']); ?></h1>
                </div>
                
                <div class="cheval-content">
                    <div class="cheval-image-container">
                        <div class="cheval-image">
                            <img src="../../modele/fonction/getImage.php?id=<?php echo htmlspecialchars($cheval['NumSir']); ?>" 
                                 alt="<?php echo htmlspecialchars($cheval['NomCheval']); ?>">
                        </div>
                    </div>
                    
                    <div class="cheval-info">
                        <div class="info-card">
                            <div class="info-item">
                                <i class="fas fa-horse"></i>
                                <span class="info-label">Race</span>
                                <span class="info-value"><?php echo htmlspecialchars($cheval['LibRace']); ?></span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-ruler-vertical"></i>
                                <span class="info-label">Taille au garrot</span>
                                <span class="info-value"><?php echo htmlspecialchars($cheval['Garot']); ?> cm</span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="info-label">Date de naissance</span>
                                <span class="info-value"><?php echo htmlspecialchars($cheval['DateNC']); ?></span>
                            </div>
                        </div>

                        <a href="../../Vue/vue_site/cavalerie.php" class="retour-btn">
                            <i class="fas fa-arrow-left"></i> Retour à la cavalerie
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="cheval-details error-message">
                <i class="fas fa-exclamation-circle"></i>
                <p>Cheval non trouvé.</p>
                <a href="../../Vue/vue_site/cavalerie.php" class="retour-btn">
                    <i class="fas fa-arrow-left"></i> Retour à la cavalerie
                </a>
            </div>
        <?php } ?>
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
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2024 Haras des Neuilles. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>