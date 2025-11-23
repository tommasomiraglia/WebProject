<?php
session_start();
<<<<<<< HEAD

require_once "/config/setting.php";
require_once "/model/DatabaseHelper.php";

$dbh = DatabaseHelper::getInstance();
=======
//define("ASSETS_DIR", "./assets/");
require_once("./database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "unired", 3306);
>>>>>>> tommaso
