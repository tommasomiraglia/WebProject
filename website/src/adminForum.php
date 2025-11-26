<?php

require_once __DIR__ ."/bootstrap.php";

$forums = $dbh->getAllForums();

if(!empty($forums)){
    $templateParams["forums"] = $forums;
} else {
    //EVENTALE REDIRECT A PAGINA DI ERRORE COMUNE//
    $templateParams["error"] = "Bravo CiccioGamer89 hai censurato tutti";
}

$templateParams["nome"] = "templates/admin-forum.php";
$templatesParams["titolo"] = "PoliHub - Gestione Forum";

require_once __DIR__ ."/templates/base.php";
