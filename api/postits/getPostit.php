<?php
$gPublic = true;
require_once __DIR__."/../../config.php";

if(isset($id) && filter_var($id, FILTER_VALIDATE_INT)){
    $stmt = $pdo->prepare("SELECT * FROM `postits` WHERE `id`=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $postit = $stmt->fetch();
} else {
    $postit = ["error"=>"Identifiant invalide"];
}

if($postit){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($postit);
    exit;
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}

