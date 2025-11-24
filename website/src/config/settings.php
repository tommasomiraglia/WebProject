<?php

class Settings {
    public const ROOT_PATH = "/WebProject/website/";
    public const BASE_PATH = self::ROOT_PATH . "src/";
    public const BASE_URL = "http://localhost" . self::BASE_PATH;
    
    // Configurazioni DB
    public const DB_SERVERNAME = "localhost";
    public const DB_USERNAME = "root";
    public const DB_PASSWORD = "";
    public const DB_DBNAME = "UniRed";
    public const DB_PORT = 3306;
}
