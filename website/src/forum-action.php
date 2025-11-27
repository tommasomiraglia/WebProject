<?php

require_once __DIR__ ."/bootstrap.php";

if(isset($_SESSION["userid"]) && isset($_POST["groupId"])){
    $userId = $_SESSION["userid"];
    $groupId = $_POST["groupId"];
    $isUserFollowing = $dbh->isUserFollowingGroup($userId, $groupId);
    if($isUserFollowing){
        $dbh->leaveGroup($userId, $groupId);
        Utils::redirect("forum.php?id=" .$groupId);
    } else {
        $dbh->joinUserGroup($userId, $groupId);
        Utils::redirect("forum.php?id=".$groupId);
    }
}
