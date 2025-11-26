<?php

require_once __DIR__ ."/bootstrap.php";

//PRENDO ID DALLA $_GET //

$groupId = -1;

if(isset($_GET["id"])){
    $groupId = $_GET["id"];
}

//PRENDO GRUPPO //

$forum = $dbh->getGroupById($groupId);

if(isset($forum)){
    $templateParams["groupdId"] = $forum["groupId"];
    $templateParams["name"] = $forum["name"];
    $templateParams["description"] = $forum["longdescription"];
    $templateParams["avatar"] = $forum["avatar"];
    $templateParams["memberCount"] = $forum["memberCount"];
}

//PRENDO POST//
$templateParams["posts"] = $dbh->getPostsByGroupId($groupId);

$templateParams["nome"] = "templates/forum-page.php";
$templateParams["titolo"] = "PoliHub - " .$templateParams["name"];

require_once __DIR__ ."/templates/base.php";
