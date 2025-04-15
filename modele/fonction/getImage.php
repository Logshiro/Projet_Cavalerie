<?php
try {
    // Charger le fichier de connexion à la base de données
    require_once __DIR__ . '/../PDO/bdd.inc.php';
    $bdd = connexionPDO();

    // Vérifier si l'ID est spécifié et valide
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id <= 0) {
        header('HTTP/1.1 400 Bad Request');
        exit;
    }

    // Préparer et exécuter la requête
    $req = $bdd->prepare('SELECT LibPhoto FROM photo WHERE RefNumSir = :RefC AND Supprime = 0 LIMIT 1');
    $req->bindParam(':RefC', $id, PDO::PARAM_INT);
    $req->execute();
    $image = $req->fetch(PDO::FETCH_ASSOC);

    if ($image && !empty($image['LibPhoto'])) {
        // Construire le chemin absolu depuis la racine du projet
        $basePath = dirname(__DIR__, 3); // Remonte à la racine du projet
        $filePath = $basePath . $image['LibPhoto'];

        // Vérifier si le fichier existe
        if (file_exists($filePath)) {
            $fileInfo = pathinfo($filePath);
            $extension = strtolower($fileInfo['extension']);
            $mimeType = match ($extension) {
                'png' => 'image/png',
                'gif' => 'image/gif',
                default => 'image/jpeg',
            };

            // Envoyer les en-têtes et l'image
            header('Content-Type: ' . $mimeType);
            readfile($filePath);
            exit;
        }
    }

    // Image par défaut
    $defaultImage = dirname(__DIR__, 3) . '/public/image/default-horse.jpg';
    if (file_exists($defaultImage)) {
        header('Content-Type: image/jpeg');
        readfile($defaultImage);
        exit;
    }

    // Erreur 404 si rien n'est trouvé
    header('HTTP/1.1 404 Not Found');
    exit;
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    exit;
}
?>