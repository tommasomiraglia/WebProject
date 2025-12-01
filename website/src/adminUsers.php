<?php

require_once __DIR__ ."/bootstrap.php";

$users= $dbh->getAllUsers();

if(!empty($users)){
    $templateParams["users"] = $users;
} else {
    //EVENTALE REDIRECT A PAGINA DI ERRORE COMUNE//
    $templateParams["error"] = "No users to show";
}

$templateParams["nome"] = "templates/admin-user.php";
$templateParams["titolo"] = "PoliHub - Gestione Utenti";

require_once __DIR__ ."/templates/base-admin.php";
