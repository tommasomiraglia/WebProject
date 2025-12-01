<?php

require_once __DIR__ ."/bootstrap.php";

$forums = $dbh->getAllForums();

if(!empty($forums)){
    $templateParams["forums"] = $forums;
} else {
    //EVENTALE REDIRECT A PAGINA DI ERRORE COMUNE//
    $templateParams["error"] = "No forum!";
}

$templateParams["nome"] = "templates/admin-forum.php";
$templateParams["titolo"] = "PoliHub - Gestione Forum";

require_once __DIR__ ."/templates/base-admin.php";
