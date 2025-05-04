<?php
require_once '../PDO/bdd.inc.php';

if (isset($_POST['keywordGalop'])) {
    $keyword = $_POST['keywordGalop'];
    $sql = "SELECT idGalop, LibGalop FROM galop WHERE LibGalop LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_Galop(\''.str_replace("'", "\\'", $data['LibGalop']).'\',\''.$data['idGalop'].'\')">'
                    .htmlspecialchars($data['LibGalop']).'</a>';
    }
    echo $list;
} else {
    if (isset($_POST['keywordGalopI'])) {
        $keyword = $_POST['keywordGalopI'];
        $sql = "SELECT idGalop, LibGalop FROM galop WHERE LibGalop LIKE :keyword AND Supprime = 0";
        $Con = connexionPDO();
        $req = $Con->prepare($sql);
        $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
        $req->execute();
        
        $list = '';
        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $list .= '<a href="#" class="list-group-item list-group-item-action" 
                        onclick="set_item_GalopI(\''.str_replace("'", "\\'", $data['LibGalop']).'\',\''.$data['idGalop'].'\')">'
                        .htmlspecialchars($data['LibGalop']).'</a>';
        }
        echo $list;
    }
}

if (isset($_POST['keywordCL'])) {
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
} else {
    if (isset($_POST['keywordInsertCL'])) {
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
}