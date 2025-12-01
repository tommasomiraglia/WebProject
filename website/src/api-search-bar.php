<?php
// 1. Deve includere il file dove è definita la connessione ($dbh)
// e dove è definita la funzione getLiveSearch (es. tramite $dbh->getLiveSearch)
require_once __DIR__ ."/bootstrap.php";

// 2. Impostazione dell'Header (IMPORTANTE)
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Termine di ricerca non valido.', 'results' => []];

if (isset($_GET['q'])) {
    $searchTerm = trim($_GET['q']);
    
    if (strlen($searchTerm) >= 2) {
        
        // Assumendo che $dbh sia il tuo oggetto con la funzione getLiveSearch
        $results = $dbh->getLiveSearch($searchTerm); 
        
        $response['success'] = true;
        $response['results'] = $results;
        $response['message'] = count($results) > 0 ? 'Risultati trovati.' : 'Nessun gruppo trovato.';
        
    } else {
        $response['success'] = true;
        $response['message'] = 'Digita almeno 2 caratteri.';
    }
}

// 3. Invio della Risposta JSON
echo json_encode($response);

// 4. Terminazione dello script API (CRUCIALE)
exit;
?>