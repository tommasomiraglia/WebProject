<?php
require_once __DIR__ . "/bootstrap.php";

header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Non autorizzato']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'delete_forum') {
        $forumId = intval($_POST['forumId']); 
        
        $result = $dbh->deleteForum($forumId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Errore nel database o forum non trovato']);
        }
        exit;
    }
}
echo json_encode(['success' => false, 'message' => 'Richiesta non valida']);
?>