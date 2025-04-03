<?php
session_start();
//var_dump($_SESSION); // Pour voir le contenu de la session
require_once $racine."/PDO/bdd.inc.php"; 
require_once $racine."/class/class_cavalier.php";
require_once $racine."/class/class_pension.php";
require_once $racine."/class/class_prend.php";
require_once $racine."/class/class_cours.php";
if (isset($_SESSION['user'])) {
    $mail = $_SESSION['user']['mail'];
    //var_dump($mail);
} else {
    throw new Exception("L'adresse e-mail n'est pas définie.");
}

// Initialisation de la connexion PDO
$pdo = connexionPDO(); // Appel de la fonction pour obtenir la connexion

// Vérification de la connexion PDO
if (!$pdo) {
    throw new Exception("La connexion à la base de données a échoué.");
}

try {
   //On crée un nouvel objet Cavalier
    $C_cavalier = new Cavalier("","","","","","","","","","","","","","");
    $stmtCavalier = $pdo->prepare("SELECT * FROM cavalier WHERE MailResponsable = :mail");
    $stmtCavalier->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmtCavalier->execute();
    $cavalier = $stmtCavalier->fetch(PDO::FETCH_ASSOC);

    if (!$cavalier) {
        throw new Exception("Cavalier non trouvé pour l'adresse e-mail : " . htmlspecialchars($mail));
    }

    $refCavalier = $cavalier['idCavalier'];

    // Récupération des informations de pension
    $stmtPension = $pdo->prepare("SELECT idPension,LibPension, Tarifs, DateDebutP, DateFinP, RefNumSir 
                                   FROM pension p
                                   WHERE RefCavalier = :refCavalier and p.supprime=0");
    $stmtPension->bindParam(':refCavalier', $refCavalier, PDO::PARAM_INT);
    $stmtPension->execute();
    $pension = $stmtPension->fetch(PDO::FETCH_ASSOC);

    // Récupération des cours auxquels le cavalier est inscrit avec jour et horaire
    $stmtCours = $pdo->prepare("SELECT c.idCours, c.Libcours, c.jour, c.HD, c.HF 
                                 FROM inscrit i 
                                 JOIN cours c ON i.RefCours = c.idCours 
                                 WHERE i.RefCavalier = :refCavalier and c.supprime=0");
    $stmtCours->bindParam(':refCavalier', $refCavalier, PDO::PARAM_INT);
    $stmtCours->execute();
    $cours = $stmtCours->fetchAll(PDO::FETCH_ASSOC) ?: []; // Assurez-vous que $cours est un tableau vide si aucun cours n'est trouvé

} catch (Exception $e) {
    // Gestion de l'exception
    echo "Erreur : " . htmlspecialchars($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Suppression de la pension
    if (isset($_POST['action']) && $_POST['action'] === 'Supprimer') {
        if (isset($_POST['idPension'])) {
            $idPension = $_POST['idPension'];
            $pension = new Pension();
            if ($pension->delete($idPension)) {
                header("Location: ?action=espace_personnel");
                exit();
            } else {
                echo "Erreur lors de la suppression de la pension.";
            }
        } 
    }

    // Suppression du cours
    if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
        if (isset($_POST['idCours'])) {
            $idCours = $_POST['idCours'];
            $cours = new Cours("","","","","",""); // Remplacez arg1 à arg6 par les valeurs appropriées
            if ($cours->delete($idCours)) {
                header("Location: ?action=espace_personnel");
                exit();
            } else {
                echo "Erreur lors de la suppression du cours.";
            }
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haras des Neuilles</title>
    <link rel="stylesheet" href="Css/css_site/styles.css">
    <link rel="stylesheet" href="Css/css_site/espace_personnel.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
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

    <div class="container">
        <aside class="sidebar">
            <h1>Bienvenue dans votre espace personnel, <?php echo htmlspecialchars($cavalier['NomCavalier']); ?>!</h1>
            <img src="image/chevauxnice.jpg" alt="Logo Le Haras des Neuilles" class="logo">
        </aside>

        <main class="main-content">
            <h2>Informations du Cavalier</h2>
            <table>
                <tr>
                    <th>Numéro de Licence</th>
                    <td><?php echo htmlspecialchars($cavalier['Numlicence']); ?></td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td><?php echo htmlspecialchars($cavalier['NomCavalier']); ?></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td><?php echo htmlspecialchars($cavalier['PrenomCavalier']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($mail); ?></td>
                </tr>
                <tr>
                    <th>Date de Naissance</th>
                    <td><?php echo htmlspecialchars($cavalier['DateNaissanceCavalier']); ?></td>
                </tr>
                <tr>
                    <th>Galop</th>
                    <td><?php echo htmlspecialchars($C_cavalier->getCavalierRefG($cavalier['RefG'])); ?></td>
                </tr>
                <tr>
                    <th>Numéro</th>
                    <td><?php echo htmlspecialchars($cavalier['TelResponsable']); ?></td>
                </tr>
                <tr>
                    <th>Ville</th>
                    <td><?php echo htmlspecialchars($cavalier['Nomcommune'] ?? 'Inconnu') . ' (' . htmlspecialchars($cavalier['COPResponsable'] ?? 'Inconnu') . ')'; ?></td>
                </tr>
            </table>

            <h2>Votre Pension</h2>
            <?php if ($pension): ?>
                <table>
                    <tr>
                        <th>Type de Pension</th>
                        <td><?php echo htmlspecialchars($pension['LibPension']); ?></td>
                    </tr>
                    <tr>
                        <th>Tarifs</th>
                        <td><?php echo htmlspecialchars($pension['Tarifs']); ?></td>
                    </tr>
                    <tr>
                        <th>Date de Début</th>
                        <td><?php echo htmlspecialchars($pension['DateDebutP']); ?></td>
                    </tr>
                    <tr>
                        <th>Date de Fin</th>
                        <td><?php echo htmlspecialchars($pension['DateFinP']); ?></td>
                    </tr>
                </table>
                <form action="" method="post">
                    <input type="hidden" name="idPension" value="<?php echo htmlspecialchars($pension['idPension']); ?>">
                    <input type="hidden" name="action" value="Supprimer">
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pension ?');">Supprimer la Pension</button>
                </form>
            <?php else: ?>
                <p>Aucune information de pension disponible.</p>
            <?php endif; ?>

            <h2>Vos Cours</h2>
            <?php if (!empty($cours)): ?>
                <table>
                    <tr>
                        <th>Libellé du Cours</th>
                        <th>Jour</th>
                        <th>Heure</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($cours as $coursItem): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($coursItem['Libcours']); ?></td>
                            <td><?php echo htmlspecialchars($coursItem['jour']); ?></td>
                            <td><?php echo htmlspecialchars($coursItem['HD']) . ' à ' . htmlspecialchars($coursItem['HF']); ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="idCours" value="<?php echo htmlspecialchars($coursItem['idCours']); ?>">
                                    <input type="hidden" name="action" value="Supprimer">
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">Supprimer le Cours</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Aucun cours disponible.</p>
            <?php endif; ?>
        </main>
    </div>

    <a href="?action=deconnexion" class="btn-deconnexion">Se déconnecter</a>
</body>
</html>