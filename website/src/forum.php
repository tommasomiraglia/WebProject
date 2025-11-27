<?php

require_once __DIR__ ."/bootstrap.php";
$groupId = -1;
if(isset($_GET["id"])){
    $groupId = $_GET["id"];
}

$forum = $dbh->getGroupById($groupId);

if(isset($forum)){
    $templateParams["groupId"] = $forum["groupId"];
    $templateParams["name"] = $forum["name"];
    $templateParams["description"] = $forum["longdescription"];
    $templateParams["avatar"] = $forum["avatar"];
    $templateParams["memberCount"] = $forum["memberCount"];
}
$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;

//CHECK IF USER IS A PARTICIPANT OF THE GROUP

$isUserFollowing = $dbh->isUserFollowingGroup($userId, $groupId);

if ($isUserFollowing){
    $templateParams["textButton"] = "Leave";
} else {
    $templateParams["textButton"] = "Join";
}

$templateParams["posts"] = $dbh->getPostsByGroupId($groupId);
$templateParams["nome"] = "templates/forum-page.php";
$nomeGruppo = isset($templateParams["name"]) ? $templateParams["name"] : "Gruppo non trovato";
$templateParams["titolo"] = "PoliHub - " . $nomeGruppo;

require_once __DIR__ ."/templates/base.php";
