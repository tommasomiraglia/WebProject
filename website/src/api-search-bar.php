<?php
require_once __DIR__ ."/bootstrap.php";

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid search term.', 'results' => []];

if (isset($_GET['q'])) {
    $searchTerm = trim($_GET['q']);
    
    if (strlen($searchTerm) >= 2) {
        $results = $dbh->getLiveSearch($searchTerm); 
        
        $response['success'] = true;
        $response['results'] = $results;
        $response['message'] = count($results) > 0 ? 'Results found.' : 'No groups found.';
        
    } else {
        $response['success'] = true;
        $response['message'] = 'Please enter at least 2 characters.';
    }
}
echo json_encode($response);
exit;
?>