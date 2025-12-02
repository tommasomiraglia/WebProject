<?php
require_once __DIR__ . "/bootstrap.php";

header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Non autorizzato']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'delete_user') {
        if (!isset($_POST['userId'])) {
             echo json_encode(['success' => false, 'message' => 'ID Utente mancante']);
             exit;
        }

        $userId = intval($_POST['userId']); 
        if ($userId === $_SESSION['userid']) {
            echo json_encode(['success' => false, 'message' => 'Non puoi bannare te stesso!']);
            exit;
        }
        $result = $dbh->deleteUser($userId);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Errore nel database o utente non trovato']);
        }
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Richiesta non valida']);
?>