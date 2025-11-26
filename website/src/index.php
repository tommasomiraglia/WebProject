<?php
require_once(__DIR__ . "/bootstrap.php");
$templateParams["titolo"] = "PoliHub - Homepage";
$templateParams["nome"] = "templates/home.php"; 

$templateParams["storie"] = $dbh->getTopPosts(3);

// 1. Definisco $userid (Se l'utente è loggato prendo il suo ID, altrimenti metto -1)
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;

// 2. Passo $userid alla funzione (così risolvi l'errore dei parametri mancanti)
$templateParams["posts"] = $dbh->getPosts(10, $userid);

require("templates/base.php");
