<?php
require_once __DIR__ . "/bootstrap.php";

header('Content-Type: application/json');
if (!isset($_SESSION['userid'])  ) {
    echo json_encode(['success' => false, 'message' => 'Non autorizzato']);
    exit;
}

if (isset($_POST["action"]) && isset($_POST["postId"])) {
    $action = $_POST["action"];
    $postId = intval($_POST["postId"]);
    $result = false;

    if ($action === "dismiss") {
        $result = $dbh->dismissReport($postId);
        $message = "Segnalazione ignorata.";
    } elseif ($action === "delete") {
        $result = $dbh->deletePost($postId);
        $message = "Post eliminato.";
    } else {
        echo json_encode(["success" => false, "message" => "Azione non valida"]);
        exit;
    }

    if ($result) {
        echo json_encode(["success" => true, "message" => $message]);
    } else {
        echo json_encode(["success" => false, "message" => "Errore durante l'operazione sul database."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Dati mancanti."]);
}
?>