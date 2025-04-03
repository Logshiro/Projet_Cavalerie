<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<!-- http://localhost/gestion_centre_equestre-ProjectC/vue_cavalier.php -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link rel="stylesheet" href="Css/css_site/inscription.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="Js/site.js/Script_site.js"></script>
    <script src="Js/jquery.min.js"></script>
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

    <main class="register-container">
        <div class="register-header">
            <h1>Inscription Cavalier</h1>
            <?php if(isset($_SESSION['erreur'])){
                    echo "<div class='alert alert-danger'>".$_SESSION['erreur']."</div>";
                    unset($_SESSION['erreur']);
                }
                if(isset($_SESSION['message'])){
                    echo "<div class='alert alert-success'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
            ?>
        </div>
        <form action="?action=inscription_site" method="post" class="register-form">
            <div class="form-row">
                <div class="form-group">
                    <input type="number" id="numLicence" name="numLicence" placeholder="Numéro de licence" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" id="nomCavalier" name="nomCavalier" placeholder="Nom" maxlength="30" required>
                </div>
                <div class="form-group">
                    <input type="text" id="prenomCavalier" name="prenomCavalier" placeholder="Prénom" maxlength="30"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" id="nomResponsable" name="nomResponsable" placeholder="Nom du responsable"
                        maxlength="30" required>
                </div>
                <div class="form-group">
                    <input type="text" id="prenomResponsable" name="prenomResponsable"
                        placeholder="Prénom du responsable" maxlength="30" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="tel" id="telResponsable" name="telResponsable" placeholder="Téléphone" maxlength="30"
                        required>
                </div>
                <div class="form-group">
                    <input type="email" id="mail" name="mail" placeholder="Email" maxlength="30" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="password" id="passwordResponsable" name="passwordResponsable"
                        placeholder="Mot de passe" maxlength="30" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Confirmer le mot de passe"
                        maxlength="30" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" id="COPResponsable" name="COPResponsable" placeholder="COP" maxlength="30" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" id="nomCommune" name="nomCommune" placeholder="Commune" maxlength="30" required>
                </div>
                <div class="form-group">
                    <input type="text" id="assurance" name="assurance" placeholder="Assurance" maxlength="30" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="date" id="dateNaissanceCavalier" name="dateNaissanceCavalier"
                        placeholder="Date de naissance" required>
                </div>
            </div>

            <div class="form-group">
                <!-- On crée un champ pour la référence G -->
                <input type="text" name="RefG" id="RefG" placeholder="Galop" onkeyup="autocompletRefG_Insert()" class="form-control" required>
                <div id="nom_list_idRefG" class="list-group"></div>
                <input type="hidden" name="idGalop" id="idGalop">
            </div>

            <button type="submit" class="cta-button">S'inscrire</button>
        </form>
        <div class="register-footer">
            <p>Déjà inscrit ? <a href="?action=connexion_site">Connectez-vous</a></p>
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
            <div class="footer-section">
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