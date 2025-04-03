<?php

require_once '../PDO/bdd.inc.php';
 // puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 
 
 if (isset($_POST['keyword'])) {
    $keyword = '%' . $_POST['keyword'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM galop WHERE LibGalop LIKE (:var) AND Supprime = 0 ORDER BY idGalop ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keyword'], '<b>' . htmlspecialchars($_POST['keyword'], ENT_QUOTES) . '</b>', $res['LibGalop']);
                echo '<li onclick="set_itemGalop(\'' . str_replace("'", "\'", htmlspecialchars($res['LibGalop'], ENT_QUOTES)) . '\', ' . htmlspecialchars($res['idGalop'], ENT_QUOTES) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
}else{
    if (isset($_POST['keywordInsert'])){
    // Prépare le mot-clé pour la recherche avec les jokers pour LIKE dans SQL
    $keyword = '%' . $_POST['keywordInsert'] . '%'; 

    // Connexion à la base de données
    $Con = connexionPDO(); 
    $sql = "SELECT * FROM galop WHERE LibGalop LIKE :var ORDER BY idGalop ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordInsert'], '<b>' . htmlspecialchars($_POST['keywordInsert'], ENT_QUOTES) . '</b>',$res['LibGalop']);
                echo '<li onclick="set_item_InsertGalop(\''. str_replace("'", "\\'", htmlspecialchars($res['LibGalop'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['idGalop']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
    }

 }