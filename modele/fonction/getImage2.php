<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=crud;charset=utf8', 'root', 'root');
    
    if(isset($_GET['id'])) {
        $req = $bdd->prepare('SELECT LibPhoto FROM photo WHERE Refevenement = ?');
        $req->execute(array($_GET['id']));
        $image = $req->fetch();
        
        if($image) {
            $filePath = '../../' . $image['LibPhoto'];
            if (file_exists($filePath)) {
                $fileInfo = pathinfo($filePath);
                $extension = strtolower($fileInfo['extension']);
                $mimeType = 'image/jpeg';

                if ($extension === 'png') {
                    $mimeType = 'image/png';
                } elseif ($extension === 'gif') {
                    $mimeType = 'image/gif';
                }

                header('Content-Type: ' . $mimeType);
                readfile($filePath);
            } else {
                echo 'Fichier image non trouvé : ' . htmlspecialchars($filePath);
            }
        } else {
            echo 'Image non trouvée pour l\'ID : ' . htmlspecialchars($_GET['id']);
        }
    } else {
        echo 'ID non spécifié.';
    }
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
?>