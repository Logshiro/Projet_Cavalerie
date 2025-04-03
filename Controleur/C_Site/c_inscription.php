<?php
require_once "$racine/PDO/bdd.inc.php"; // Inclusion de la connexion PDO
require_once "c_cavalierI.php"; // inscrit le cavalier

    if (!empty($MailResponsable) && !empty($PasswordResponsable)) {
        try {
            // Connexion à la base de données
            $pdo = connexionPDO();

            // Vérifier si l'utilisateur existe déjà
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM utilisateurs WHERE mail = ?');
            $stmt->execute([$MailResponsable]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $_SESSION['erreur'] = "Erreur : cet email est déjà utilisé.";
            } else {
                // Hacher le mot de passe
                $hashedPassword = password_hash($PasswordResponsable, PASSWORD_BCRYPT);
                $RefRole = 2;

                // Insérer l'utilisateur dans la base de données
                $stmt = $pdo->prepare('INSERT INTO utilisateurs (mail, PasswordA, RefRole) VALUES (?, ?, ?)');
                $stmt->execute([$MailResponsable, $hashedPassword, $RefRole]);

                $valide = true;
                $_SESSION['message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        } catch (PDOException $e) {
            $_SESSION['erreur'] = "Erreur : " . $e->getMessage();
        }
    }

if ($valide){
    require_once "$racine/Vue/Vue_Site/connexion.php";
    die();
}else{
        require_once "$racine/Vue/Vue_Site/inscription.php";
        die();
    }