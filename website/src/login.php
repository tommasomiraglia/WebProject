<?php

require_once __DIR__ ."/bootstrap.php";

if (isset($_POST["username"]) && isset($_POST["password"])){
    $user = $dbh->checkLogin($_POST["username"],$_POST["password"]);
    if(isset($user)){
        Utils::registerLoggedUser($user);
        Utils::redirect("/index.php");
    } else {
        $templateParams["errorelogin"] = "Alex dai vieni a Buildare";
    }
}

if(Utils::isUserLoggedIn()){
    Utils::redirect("/index.php");
} else {
    $templateParams["titolo"] = "PoliHub - Log In";
    $templateParams["nome"] = "templates/form-login.php";
}

require_once __DIR__ ."/templates/base.php";
