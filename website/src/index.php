<?php
// 1. Includo la configurazione di base
require_once(__DIR__ . "/bootstrap.php");

// 2. Imposto i dati per la pagina
$templateParams["titolo"] = "PoliHub - Homepage";
$templateParams["nome"] = "template/home.php"; // Dico a base.php di caricare home.php al centro

// 3. Prendo i post dal DB
// Attenzione: getPosts() deve esistere nel tuo DatabaseHelper
//$templateParams["articoli"] = $dbh->getPosts(10); 

// 4. Carico il layout grafico
require("template/base.php");
