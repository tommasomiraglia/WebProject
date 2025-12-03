<?php
require_once __DIR__ ."/bootstrap.php";

$templateParams["nome"] = "templates/sign-up-form.php";
$templateParams["titolo"] = "PoliHub - Sign Up";
$templateParams["gender"] = $dbh->getGender();

if(Utils::isUserLoggedIn()){
    Utils::redirect("index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) ||
       empty($_POST["gender"]) || $_POST["gender"] == "Select Gender" || empty($_POST["description"]) ||
       !isset($_FILES["profileImage"]) || $_FILES["profileImage"]["error"] !== UPLOAD_ERR_OK){
        
        $templateParams["error"] = "Dati mancanti o errore nel caricamento dell'immagine.";
    
    } else {
        $username = trim($_POST["username"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $description = $_POST["description"];
        
        $avatarPath = NULL;
        $destinationPath = Settings::ABSOLUTE_UPLOAD_AVATAR_DIR;

        list($result, $msg) = Utils::uploadImage($destinationPath, $_FILES["profileImage"]);
        
        if ($result == 1) {
            $avatarName = $msg;
            $avatarPath = Settings::UPLOAD_AVATAR_DIR . $avatarName;
        } else {
            $templateParams["error"] = "Errore nel caricamento dell'avatar: " . $msg;
            require_once __DIR__ ."/templates/base.php";
            return;
        }

        $cond = $dbh->isUserAvailable($username,$email);

        if(!$cond){
            $templateParams["error"] = "Username o email già esistenti. Accedi al tuo account.";
        } else {
            // 3. Chiama il metodo DB includendo il percorso dell'avatar
            // NOTA: Dovrai aggiornare addUser nel tuo DatabaseHelper per accettare $avatarPath
            $dbh->addUser($username, $email, $password, $gender, $avatarPath, $description);
            
            $user = $dbh->checkLogin($username,$password);
            Utils::registerLoggedUser($user);
            Utils::redirect("index.php");
        }
    }
}

require_once __DIR__ ."/templates/base.php";
