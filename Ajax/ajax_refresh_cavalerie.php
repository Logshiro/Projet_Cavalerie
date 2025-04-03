<?php

//Inclusion du fichier de connexion à la base de données
include '../PDO/bdd.inc.php';
 // puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 
 
 if (isset($_POST['keywordRace'])) {
    $keywordRace = '%' . $_POST['keywordRace'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM race WHERE LibRace LIKE (:var) AND Supprime = 0 ORDER BY idRace ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordRace, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordRace'], '<b>' . htmlspecialchars($_POST['keywordRace'], ENT_QUOTES) . '</b>', $res['LibRace']);
                echo '<li onclick="set_item_Race(\''. str_replace("'", "\\'", htmlspecialchars($res['LibRace'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idRace']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
}else{
    if (isset($_POST['keywordRaceI'])){
    // Prépare le mot-clé pour la recherche avec les jokers pour LIKE dans SQL
    $keywordRace = '%' . $_POST['keywordRaceI'] . '%'; 

    // Connexion à la base de données
    $Con = connexionPDO(); 
    $sql = "SELECT * FROM race  WHERE LibRace LIKE :var ORDER BY idRace ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordRace, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordRaceI'], '<b>' . htmlspecialchars($_POST['keywordRaceI'], ENT_QUOTES) . '</b>',$res['LibRace']);
                echo '<li onclick="set_item_RaceI(\''. str_replace("'", "\\'", htmlspecialchars($res['LibRace'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idRace']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
    }

 }

 if (isset($_POST['keywordRobe'])) {
    $keywordRobe = '%' . $_POST['keywordRobe'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM robe WHERE LibRobe LIKE (:var) AND Supprime = 0 ORDER BY idRobe ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordRobe, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordRobe'], '<b>' . htmlspecialchars($_POST['keywordRobe'], ENT_QUOTES) . '</b>', $res['LibRobe']);
                echo '<li onclick="set_item_Robe(\''. str_replace("'", "\\'", htmlspecialchars($res['LibRobe'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idRobe']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
}else{
    if (isset($_POST['keywordRobeI'])){
    // Prépare le mot-clé pour la recherche avec les jokers pour LIKE dans SQL
    $keywordRobe = '%' . $_POST['keywordRobeI'] . '%'; 

    // Connexion à la base de données
    $Con = connexionPDO(); 
    $sql = "SELECT * FROM robe WHERE LibRobe LIKE :var ORDER BY idRobe ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordRobe, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordRobeI'], '<b>' . htmlspecialchars($_POST['keywordRobeI'], ENT_QUOTES) . '</b>',$res['LibRobe']);
                echo '<li onclick="set_item_RobeI(\''. str_replace("'", "\\'", htmlspecialchars($res['LibRobe'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idRobe']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
    }
 }
