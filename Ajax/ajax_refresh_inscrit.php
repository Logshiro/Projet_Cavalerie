<?php

//Inclusion du fichier de connexion à la base de données
include '../PDO/bdd.inc.php';
 // puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 
 
 if (isset($_POST['keywordCoursI'])) {
    $keywordCours = '%' . $_POST['keywordCoursI'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM cours WHERE Libcours LIKE (:var) AND Supprime = 0 ORDER BY idCours ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordCours, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordCoursI'], '<b>' . htmlspecialchars($_POST['keywordCoursI'], ENT_QUOTES) . '</b>', $res['Libcours']);
                echo '<li onclick="set_item_CoursI(\''. str_replace("'", "\\'", htmlspecialchars($res['Libcours'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idCours']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
}else{
    if (isset($_POST['keywordCoursE'])){
    // Prépare le mot-clé pour la recherche avec les jokers pour LIKE dans SQL
    $keywordCours = '%' . $_POST['keywordCoursE'] . '%'; 

    // Connexion à la base de données
    $Con = connexionPDO(); 
    $sql = "SELECT * FROM cours  WHERE Libcours LIKE :var ORDER BY idCours ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordCours, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordCoursE'], '<b>' . htmlspecialchars($_POST['keywordCoursE'], ENT_QUOTES) . '</b>',$res['Libcours']);
                echo '<li onclick="set_item_CoursE(\''. str_replace("'", "\\'", htmlspecialchars($res['Libcours'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idCours']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
    }

 }

 if (isset($_POST['keywordCavalierI'])) {
    $keywordCavalier = '%' . $_POST['keywordCavalierI'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM cavalier WHERE NomCavalier LIKE (:var) AND Supprime = 0 ORDER BY idCavalier ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordCavalier, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordCavalierI'], '<b>' . htmlspecialchars($_POST['keywordCavalierI'], ENT_QUOTES) . '</b>', $res['NomCavalier']);
                echo '<li onclick="set_item_CavalierI(\''. str_replace("'", "\\'", htmlspecialchars($res['NomCavalier'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idCavalier']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
}else{
    if (isset($_POST['keywordCavalierE'])){
    // Prépare le mot-clé pour la recherche avec les jokers pour LIKE dans SQL
    $keywordCavalier = '%' . $_POST['keywordCavalierE'] . '%'; 

    // Connexion à la base de données
    $Con = connexionPDO(); 
    $sql = "SELECT * FROM cavalier WHERE NomCavalier LIKE :var ORDER BY idCavalier ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keywordCavalier, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordCavalierE'], '<b>' . htmlspecialchars($_POST['keywordCavalierE'], ENT_QUOTES) . '</b>',$res['NomCavalier']);
                echo '<li onclick="set_item_CavalierE(\''. str_replace("'", "\\'", htmlspecialchars($res['NomCavalier'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idCavalier']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
    }
 }
