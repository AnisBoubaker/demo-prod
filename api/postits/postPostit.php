<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json'){
    http_response_code(400);
    exit;
}

//Obtenir le corps de la requête
$body = json_decode(file_get_contents("php://input"));

if(!isset($body->title) || $body->title == ""){
    http_response_code(400);
    echo "Le titre est obligatoire";
    exit;
}

if(!isset($body->content) || $body->content == ""){
    http_response_code(400);
    echo "Le contenu est obligatoire";
    exit;
}

try{
    $stmt = $pdo->prepare("INSERT INTO `postits` (`title`, `content`, `user_id`) VALUES (:title, :content, :user)");
    $stmt->bindValue(":title", $body->title);
    $stmt->bindValue(":content", $body->content);
    $stmt->bindValue(":user", $gUserId);
    $stmt->execute();

    $insertion = ["id"=>$pdo->lastInsertId(), "title"=>$body->title, "content"=>$body->content];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($insertion);
} catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}


