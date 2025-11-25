<?php
// 1. Includo la configurazione di base
require_once(__DIR__ . "/bootstrap.php");

// 2. Imposto i dati per la pagina
$templateParams["titolo"] = "PoliHub - Homepage";
$templateParams["nome"] = "templates/home.php"; // Dico a base.php di caricare home.php al centro

// 3. Prendo le storie dal DB
$templateParams["storie"] = $dbh->getTopPosts(3);

// 4. Carico il layout grafico
require("templates/base.php");
