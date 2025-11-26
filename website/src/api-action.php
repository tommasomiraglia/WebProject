<?php
require_once __DIR__ . "/bootstrap.php";
header('Content-Type: application/json');

if(!Utils::isUserLoggedIn()){
    echo json_encode(["success" => false, "message" => "You must log in"]);
    exit;
}
if(isset($_POST['action']) && isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    $userId = $_SESSION['userid']; 
    $action = $_POST['action'];
    if($action === 'vote' && isset($_POST['is_upvote'])) {
        $isUpvote = $_POST['is_upvote']; 
        $result = $dbh->toggleVote($postId, $userId, $isUpvote);
        echo json_encode(["success" => true, "status" => $result['status'], "type" => $result['type']]);
    } elseif ($action === 'report') {
        $res = $dbh->reportPost($postId);
        echo json_encode(["success" => $res]);
    } else {
        echo json_encode(["success" => false, "message" => "Azione non valida"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Dati mancanti"]);
}
?>