<?php

require_once '../PDO/bdd.inc.php';
 // puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 
 
 if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $sql = "SELECT idGalop, LibGalop FROM galop WHERE LibGalop LIKE :keyword AND Supprime = 0";
    $Con = connexionPDO();
    $req = $Con->prepare($sql);
    $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $req->execute();
    
    $list = '';
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $list .= '<a href="#" class="list-group-item list-group-item-action" 
                    onclick="set_itemGalop(\''.str_replace("'", "\\'", $data['LibGalop']).'\',\''.$data['idGalop'].'\')">'
                    .htmlspecialchars($data['LibGalop']).'</a>';
    }
    echo $list;
} else {
    if (isset($_POST['keywordInsert'])) {
        $keyword = $_POST['keywordInsert'];
        $sql = "SELECT idGalop, LibGalop FROM galop WHERE LibGalop LIKE :keyword AND Supprime = 0";
        $Con = connexionPDO();
        $req = $Con->prepare($sql);
        $req->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
        $req->execute();
        
        $list = '';
        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $list .= '<a href="#" class="list-group-item list-group-item-action" 
                        onclick="set_item_InsertGalop(\''.str_replace("'", "\\'", $data['LibGalop']).'\',\''.$data['idGalop'].'\')">'
                        .htmlspecialchars($data['LibGalop']).'</a>';
        }
        echo $list;
    }
}