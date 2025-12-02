<?php
require_once __DIR__ ."/bootstrap.php";

// 1. RECUPERO ID POST
$postId = -1;
if(isset($_GET["postId"])){
    $postId = $_GET["postId"];
}

// 2. RECUPERO CHI STA GUARDANDO (Fondamentale per i colori dei Like!)
$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;

// 3. GESTIONE INSERIMENTO COMMENTO
if(isset($_POST["testoCommento"])){
    if(Utils::isUserLoggedIn()){
        $testo = $_POST["testoCommento"];
        // $userId è già definito sopra, lo uso qui
        $dbh->insertComment($postId, $userId, $testo);
        
        header("Location: comment.php?postId=" . $postId);
        exit; 
    }
}

// 4. RECUPERO DATI POST (Passando $userId!)
// Passo $userId così il DB controlla se ho messo like
$post = $dbh->getPostById($postId, $userId); 

if(empty($post)){
    $templateParams["error"] = "Post not found!";
} else {
    $templateParams["post"] = $post;
}

$comments = $dbh->getCommentsByPostId($postId);

if(empty($comments)){
    $templateParams["noComment"] = "No comments. Be the first to post!"; 
} else {
    $templateParams["comments"] = $comments;
}

$templateParams["nome"] = "templates/comment-page.php";
$templateParams["titolo"] = "PoliHub - Comments";

require_once __DIR__ ."/templates/base.php";
?>