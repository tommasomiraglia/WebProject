<?php
require_once __DIR__ ."/bootstrap.php";

$postId = -1;
if(isset($_GET["postId"])){
    $postId = $_GET["postId"];
}

$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;

if(isset($_POST["testoCommento"])){
    if(Utils::isUserLoggedIn()){
        $testo = $_POST["testoCommento"];
        $dbh->insertComment($postId, $userId, $testo);
        
        header("Location: comment.php?postId=" . $postId);
        exit; 
    }
}

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