<?php

require_once __DIR__ ."/bootstrap.php";

$templateParams["nome"] = "templates/upload-form.php";
$templateParams["titolo"] = "PoliHub - Upload";
$groupId = -1;

if(isset($_GET["groupId"])){
    $groupId = (int)$_GET["groupId"];
}

if(isset($_POST["groupId"])){
    $groupId = (int)$_POST["groupId"];
}

if(Utils::isUserLoggedIn() && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(empty($_POST["title"]) || empty($_POST["description"])) {
        $templateParams["error"] = "Dati essenziali mancanti (Titolo e Descrizione).";
    } else {
        $userId = $_SESSION["userid"];
        $title = $_POST["title"];
        $longdescription = $_POST["description"];
        
        $postImagePath = NULL;
        if (isset($_FILES["postImage"]) && $_FILES["postImage"]["error"] === UPLOAD_ERR_OK) {
            
            $destinationPath = Settings::ABSOLUTE_UPLOAD_POST_DIR;

            list($result, $msg) = Utils::uploadImage($destinationPath, $_FILES["postImage"]);

            if ($result == 1) {
                $postImageName = $msg;
                $postImagePath = Settings::UPLOAD_POST_DIR . $postImageName;

            } else {
                $templateParams["error"] = "Errore nel caricamento dell'immagine: " . $msg;
                require_once __DIR__ ."/templates/base.php";
                return;
            }
        }
        
        $dbh->uploadPost($userId, $groupId, $title, $longdescription, $postImagePath);
        Utils::redirect("forum.php?id=".$groupId);
    }
}

require_once __DIR__ ."/templates/base.php";
