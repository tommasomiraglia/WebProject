<?php
require_once __DIR__ . "/bootstrap.php";

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

$forums = $dbh->getFollowedForums($_SESSION['userid']);
$templateParams["titolo"] = "My Forums - UniRed";
$templateParams["nome"] = "templates/favorite-list.php";
$templateParams["forums"] = $forums;

if (empty($forums)) {
    $templateParams["messaggio"] = "You don't follow any forums yet.";
}

require_once __DIR__ . "/templates/base.php";
?>