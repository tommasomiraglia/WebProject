<?php
session_start();
//define("ASSETS_DIR", "./assets/");
require_once("./database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "unired", 3306);
