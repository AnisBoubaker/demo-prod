<?php
$gPublic = true;
require_once __DIR__."/../../config.php";
$stmt = $pdo->prepare("SELECT * FROM `postits`");
$stmt->execute();

$postits = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($postits);
