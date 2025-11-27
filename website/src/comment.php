<?php

require_once __DIR__ ."/bootstrap.php";

$postId = -1;
if(isset($_GET["postId"])){
    $postId = $_GET["postId"];
}

$post = $dbh -> getPostById($postId);

if(empty($post)){
    $templateParams["error"] = "CiccioGamer è passato qua";
} else {
    $templateParams["post"] = $post;
}

$comments = $dbh-> getCommentsByPostId($postId);

if(empty($comments)){
    $templateParams["noComment"] = "CiccioGamer89 ha censutato tutti";
} else {
    $templateParams["comments"] = $comments;
}

$templateParams["nome"] = "templates/comment-page.php";
$templateParams["titolo"] = "PoliHub - Commenti";

require_once __DIR__ ."/templates/base.php";
