<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    // Stocker l'URL actuelle dans la session pour rediriger après la connexion
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    
    // Rediriger vers la page de connexion
    $message = urlencode("Veuillez vous connecter pour accéder à cette page.");
    header("Location: /index.php?action=connexion&message=$message");
    exit;
}

// Vérification du rôle Admin (uniquement si nécessaire pour la page)
if (isset($requireAdmin) && $requireAdmin === true) {
    if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'Admin') {
        $_SESSION['erreur'] = "Accès non autorisé. Vous devez être administrateur.";
        header("Location: /index.php?action=acceuil");
        exit;
    }
}
