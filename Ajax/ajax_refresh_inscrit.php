<?php
require_once '../PDO/bdd.inc.php';

// Autocomplétion pour les cavaliers
if(isset($_POST['keywordCavalierE'])) {
    $keyword = $_POST['keywordCavalierE'];
    $sql = "SELECT idCavalier, NomCavalier FROM cavalier WHERE NomCavalier LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_CavalierE(\''.str_replace("'", "\\'", $data['NomCavalier']).'\',\''.$data['idCavalier'].'\')">'
                    .htmlspecialchars($data['NomCavalier']).'</a>';
    }
    echo $list;
}

// Autocomplétion pour les cours
if(isset($_POST['keywordCoursE'])) {
    $keyword = $_POST['keywordCoursE'];
    $sql = "SELECT idCours, LibCours FROM cours WHERE LibCours LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_CoursE(\''.str_replace("'", "\\'", $data['LibCours']).'\',\''.$data['idCours'].'\')">'
                    .htmlspecialchars($data['LibCours']).'</a>';
    }
    echo $list;
}
