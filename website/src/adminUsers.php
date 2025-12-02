<?php

require_once __DIR__ ."/bootstrap.php";

$users= $dbh->getAllUsers();

if(!empty($users)){
    $templateParams["users"] = $users;
} else {
    $templateParams["errore"] = "Nessun utente da mostrare.";
}

$templateParams["nome"] = "templates/admin-user.php";
$templateParams["titolo"] = "PoliHub - Gestione Utenti";

require_once __DIR__ ."/templates/base-admin.php";
