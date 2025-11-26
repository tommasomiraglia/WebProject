<?php

require_once __DIR__ ."/bootstrap.php";

if(isset($_GET["userId"])){
    $userId = $_GET["userId"];
} else {
    $userId = -1;
}

$user = $dbh->getUserByUserId($userId);
$posts = $dbh->getPostsByUserId($userId);

//AGGIUNGERE EVENTUALI CONTROLLI SE UTENTE LOGGATO O MENO OPPURE SE RESTITUISCE QUALCOSA //

$templateParams["nome"] = "templates/user-page.php";
$templateParams["titolo"] = "PoliHub - User Page";

$templateParams["username"] = $user["username"];
$templateParams["avatar"] = $user["avatar"];
$templateParams["description"] = $user["description"];

$templateParams["posts"] = $posts;

require_once __DIR__ ."/templates/base.php";
