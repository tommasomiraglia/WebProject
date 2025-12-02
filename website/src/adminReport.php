<?php

require_once __DIR__ ."/bootstrap.php";

$reportedPost = $dbh->getReportedPosts();

if(!empty($reportedPost)){
    $templateParams["posts"] = $reportedPost;
} else {
    //EVENTALE REDIRECT A PAGINA DI ERRORE COMUNE//
    $templateParams["error"] = "No post to show!";
}

$templateParams["nome"] = "templates/admin-report.php";
$templateParams["titolo"] = "PoliHub - Report";

require_once __DIR__ ."/templates/base-admin.php";
