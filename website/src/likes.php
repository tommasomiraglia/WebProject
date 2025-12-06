<?php
require_once __DIR__ . "/bootstrap.php";

// Redirect se non loggato
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

$templateParams["titolo"] = "Posts you like - UniRed";
$templateParams["nome"] = "templates/likes-list.php";
$templateParams["posts"] = $dbh->getLikedPosts($_SESSION['userid']);

require_once __DIR__ . "/templates/base.php";
?>