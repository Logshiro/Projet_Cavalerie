<?php
require_once '../PDO/bdd.inc.php';

// Autocomplétion pour les chevaux
if(isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $sql = "SELECT NumSir, NomCheval FROM cavalerie WHERE NomCheval LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item(\''.str_replace("'", "\\'", $data['NomCheval']).'\',\''.$data['NumSir'].'\')">'
                    .htmlspecialchars($data['NomCheval']).'</a>';
    }
    echo $list;
}

// Autocomplétion pour les chevaux (insertion)
if(isset($_POST['keywordInsert'])) {
    $keyword = $_POST['keywordInsert'];
    $sql = "SELECT NumSir, NomCheval FROM cavalerie WHERE NomCheval LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_Insert(\''.str_replace("'", "\\'", $data['NomCheval']).'\',\''.$data['NumSir'].'\')">'
                    .htmlspecialchars($data['NomCheval']).'</a>';
    }
    echo $list;
}

// Autocomplétion pour les cavaliers
if(isset($_POST['keywordCL'])) {
    $keyword = $_POST['keywordCL'];
    $sql = "SELECT idCavalier, NomCavalier FROM cavalier WHERE NomCavalier LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_CL(\''.str_replace("'", "\\'", $data['NomCavalier']).'\',\''.$data['idCavalier'].'\')">'
                    .htmlspecialchars($data['NomCavalier']).'</a>';
    }
    echo $list;
}

// Autocomplétion pour les cavaliers (insertion)
if(isset($_POST['keywordInsertCL'])) {
    $keyword = $_POST['keywordInsertCL'];
    $fieldId = isset($_POST['fieldId']) ? $_POST['fieldId'] : '';
    
    $sql = "SELECT idCavalier, NomCavalier FROM cavalier WHERE NomCavalier LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_InsertCL(\''.str_replace("'", "\\'", $data['NomCavalier']).'\',\''.$data['idCavalier'].'\',\''.$fieldId.'\')">'
                    .htmlspecialchars($data['NomCavalier']).'</a>';
    }
    echo $list;
}

