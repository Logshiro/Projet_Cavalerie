<?php

include '../PDO/bdd.inc.php';
 // puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 
 
 if (isset($_POST['keyword'])) {
    $keyword = '%' . $_POST['keyword'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM cavalerie WHERE NomCheval LIKE (:var) AND Supprime = 0 ORDER BY NumSir ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keyword'], '<b>' . htmlspecialchars($_POST['keyword'], ENT_QUOTES) . '</b>', $res['NomCheval']);
                echo '<li onclick="set_item(\'' . str_replace("'", "\'", $res['NomCheval']) . '\', ' . $res['NumSir'] . ')">' . $Listecategorie . '</li>';
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
    $sql = "SELECT * FROM cavalerie WHERE NomCheval LIKE :var ORDER BY NumSir ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordInsert'], '<b>' . htmlspecialchars($_POST['keywordInsert'], ENT_QUOTES) . '</b>',$res['NomCheval']);
                echo '<li onclick="set_item_Insert(\''. str_replace("'", "\\'", htmlspecialchars($res['NomCheval'], ENT_QUOTES)) .'\', ' . htmlspecialchars($res['NumSir']) . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
    }

 }


 if (isset($_POST['keywordCL'])) {
    $keyword = '%' . $_POST['keywordCL'] . '%';

    $Con = connexionPDO(); 
    $sql = "SELECT * FROM cavalier WHERE NomCavalier LIKE (:var) AND Supprime = 0 ORDER BY idCavalier ASC LIMIT 0, 10";
    $req = $Con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);

    if ($req->execute()) {
        $list = $req->fetchAll();
        if (!empty($list)) {
            foreach ($list as $res) {
                $Listecategorie = str_replace($_POST['keywordCL'], '<b>' . htmlspecialchars($_POST['keywordCL'], ENT_QUOTES) . '</b>', $res['NomCavalier']);
                echo '<li onclick="set_item_CL(\'' . str_replace("'", "\'", $res['NomCavalier']) . '\', ' . $res['idCavalier'] . ')">' . $Listecategorie . '</li>';
            }
        } else {
            echo 'Aucun résultat trouvé';
        }
    } else {
        echo 'Erreur lors de l\'exécution de la requête SQL.';
    }
}else{
    if (isset($_POST['keywordInsertCL'])){
        $keyword = '%' . $_POST['keywordInsertCL'] . '%';
        $fieldId = isset($_POST['fieldId']) ? $_POST['fieldId'] : '';  // Récupérer l'ID unique

        $Con = connexionPDO(); 
        $sql = "SELECT * FROM cavalier WHERE NomCavalier LIKE (:var) AND Supprime = 0 ORDER BY idCavalier ASC LIMIT 0, 10";
        $req = $Con->prepare($sql);
        $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    
        if ($req->execute()) {
            $list = $req->fetchAll();
            if (!empty($list)) {
                foreach ($list as $res) {
                    $Listecategorie = str_replace($_POST['keywordInsertCL'], '<b>' . htmlspecialchars($_POST['keywordInsertCL'], ENT_QUOTES) . '</b>', $res['NomCavalier']);
                    echo '<li onclick="set_item_InsertCL(\'' . str_replace("'", "\'", $res['NomCavalier']) . '\', ' . $res['idCavalier'] . ', \'' . $fieldId . '\')">' . $Listecategorie . '</li>';
                }
            } else {
                echo 'Aucun résultat trouvé';
            }
        } else {
            echo 'Erreur lors de l\'exécution de la requête SQL.';
        }
    }

 }

