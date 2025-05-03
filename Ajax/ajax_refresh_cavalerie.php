<?php
require_once '../PDO/bdd.inc.php';

if (isset($_POST['keywordRace'])) {
    $keyword = $_POST['keywordRace'];
    $sql = "SELECT idRace, LibRace FROM race WHERE LibRace LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_Race(\''.str_replace("'", "\\'", $data['LibRace']).'\',\''.$data['idRace'].'\')">'
                    .htmlspecialchars($data['LibRace']).'</a>';
    }
    echo $list;
} else {
    if (isset($_POST['keywordRaceI'])) {
        $keyword = $_POST['keywordRaceI'];
        $sql = "SELECT idRace, LibRace FROM race WHERE LibRace LIKE :keyword AND Supprime = 0";
        $Con = connexionPDO();
        $req = $Con->prepare($sql);
        $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
        $req->execute();
        
        $list = '';
        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $list .= '<a href="#" class="list-group-item list-group-item-action" 
                        onclick="set_item_RaceI(\''.str_replace("'", "\\'", $data['LibRace']).'\',\''.$data['idRace'].'\')">'
                        .htmlspecialchars($data['LibRace']).'</a>';
        }
        echo $list;
    }
}

if (isset($_POST['keywordRobe'])) {
    $keyword = $_POST['keywordRobe'];
    $sql = "SELECT idRobe, LibRobe FROM robe WHERE LibRobe LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_item_Robe(\''.str_replace("'", "\\'", $data['LibRobe']).'\',\''.$data['idRobe'].'\')">'
                    .htmlspecialchars($data['LibRobe']).'</a>';
    }
    echo $list;
} else {
    if (isset($_POST['keywordRobeI'])) {
        $keyword = $_POST['keywordRobeI'];
        $sql = "SELECT idRobe, LibRobe FROM robe WHERE LibRobe LIKE :keyword AND Supprime = 0";
        $Con = connexionPDO();
        $req = $Con->prepare($sql);
        $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
        $req->execute();
        
        $list = '';
        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $list .= '<a href="#" class="list-group-item list-group-item-action" 
                        onclick="set_item_RobeI(\''.str_replace("'", "\\'", $data['LibRobe']).'\',\''.$data['idRobe'].'\')">'
                        .htmlspecialchars($data['LibRobe']).'</a>';
        }
        echo $list;
    }
}
