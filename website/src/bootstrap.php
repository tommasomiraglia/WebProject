<?php

require_once "config/settings.php";
require_once "model/DatabaseHelper.php";

try {
    $dbh = DatabaseHelper::getInstance();
    echo "Connessione OK!";
} catch(\Exception $e){
    echo "Errore di connessione: " . $e->getMessage();
}

