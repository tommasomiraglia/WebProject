<?php
require_once __DIR__ ."/bootstrap.php";

$templateParams["nome"] = "templates/sign-up-form.php";
$templateParams["titolo"] = "PoliHub - Sign Up";
$templateParams["gender"] = $dbh->getGender();

if(Utils::isUserLoggedIn()){
    Utils::redirect("index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["gender"]) || $_POST["gender"] == "Select Gender"){
        $templateParams["error"] = "Dati mancanti";
    } else {
        $username = trim($_POST["username"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
        $gender = $_POST["gender"];

        $cond = $dbh->isUserAvailable($username,$email);

        if(!$cond){
            $templateParams["error"] = "Username o email già esistenti. Accedi al tuo account.";
        } else {
            $dbh->addUser($username,$email,$password,$gender);
            $user = $dbh->checkLogin($username,$password);
            Utils::registerLoggedUser($user);
            Utils::redirect("index.php");
        }
    }
}

require_once __DIR__ ."/templates/base.php";
