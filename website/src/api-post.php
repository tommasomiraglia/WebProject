<?php
require_once(__DIR__ . "/bootstrap.php");
header('Content-Type: application/json');

$limit = 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;

$posts = $dbh->getPosts($limit, $offset, $userid);

foreach ($posts as &$post) {
    // Formattazione data
    $dateObj = new DateTime($post['postDate']);
    $post['formattedDate'] = $dateObj->format('d/m/Y');
    
    // Gestione avatar di default se mancante (fondamentale per il JS)
    if (empty($post['groupIcon'])) {
        $post['groupIcon'] = 'assets/avatar/avatar0.jpg';
    }
}

echo json_encode($posts);
?>