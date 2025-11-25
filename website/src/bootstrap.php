<?php

require_once "config/settings.php";
require_once "model/DatabaseHelper.php";
require_once "utils/utils.php";

try {
    $dbh = DatabaseHelper::getInstance();
} catch(\Exception $e){
    echo "Errore di connessione: " . $e->getMessage();
}

