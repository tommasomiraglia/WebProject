<?php
session_start();

require_once "/config/setting.php";
require_once "/model/DatabaseHelper.php";

$dbh = DatabaseHelper::getInstance();
