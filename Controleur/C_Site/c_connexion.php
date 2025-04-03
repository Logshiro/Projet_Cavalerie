<?php
session_start();
require_once "$racine/PDO/bdd.inc.php"; // Inclusion de la connexion PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($mail) && !empty($password)) {
        try {
            $pdo = connexionPDO();
            $stmt = $pdo->prepare("SELECT u.mail, u.passwordA, u.RefRole, r.LibRole 
                                   FROM utilisateurs u
                                   INNER JOIN role r ON u.RefRole = r.idU
                                   WHERE u.mail = :mail");
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['passwordA'])) {
                $_SESSION['user'] = [
                    'id' => $user['RefRole'],
                    'mail' => $user['mail'],
                    'role' => $user['LibRole']
                ];


                // Redirection selon le rôle
                if ($user['LibRole'] === 'Admin') {
                    $message = urlencode("Connexion réussie. Bienvenue Admin : " . htmlspecialchars($user['mail']) . "!");
                    header("Location: Vue/vue_cavalerie.php?message=$message");
                } elseif ($user['LibRole'] === 'Utilisateur') {
                    $message = urlencode(  htmlspecialchars($user['mail']) );
                    header("Location: index.php?action=espace_personnel&message=$message");
                } else {
                    $_SESSION['erreur'] = "Rôle inconnu";
                    require_once "$racine/Vue/Vue_Site/connexion.php";
                    die();
                }
            } else {
                $_SESSION['erreur'] = "Identifiants incorrects";
                require_once "$racine/Vue/Vue_Site/connexion.php";
                die();
            }
        } catch (Exception $e) {
            $_SESSION['erreur'] = "Erreur : " . $e->getMessage();
            require_once "$racine/Vue/Vue_Site/connexion.php";
            die();
        }
    } else {
        $_SESSION['erreur'] = "Rôle inconnu";
        require_once "$racine/Vue/Vue_Site/connexion.php";
        die();
    }
} else {
    require_once "$racine/Vue/Vue_Site/connexion.php";
}
?>