<?php
require_once(__DIR__ . "/bootstrap.php");
$templateParams["titolo"] = "PoliHub - Homepage";
$templateParams["nome"] = "templates/home.php"; 

$templateParams["storie"] = $dbh->getTopPosts(3);
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;
$templateParams["posts"] = $dbh->getPosts(10, $userid);

require("templates/base.php");
