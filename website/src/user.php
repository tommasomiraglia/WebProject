<?php
require_once __DIR__ ."/bootstrap.php";

$userIdProfilo = -1;
if(isset($_GET["id"])){
    $userIdProfilo = $_GET["id"];
} elseif(isset($_GET["userId"])){
    $userIdProfilo = $_GET["userId"];
}

$user = $dbh->getUserByUserId($userIdProfilo);
if($user){
    $templateParams["username"] = $user["username"];
    $templateParams["avatar"] = !empty($user["avatar"]) ? $user["avatar"] : "assets/avatar/octopus.png"; 
    $templateParams["description"] = $user["description"] ?? "No description available.";
    $viewerId = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;
    $templateParams["posts"] = $dbh->getPostsByUserId($userIdProfilo, $viewerId);

    $templateParams["nome"] = "templates/user-page.php";
    $templateParams["titolo"] = "PoliHub - Profile of " . $user["username"];

} else {
    $templateParams["titolo"] = "Utente non trovato";
}

require_once __DIR__ ."/templates/base.php";
?>