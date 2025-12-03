<?php

class Settings {
    public const ROOT_PATH = "/WebProject/website/";
    public const BASE_PATH = self::ROOT_PATH . "src/";
    public const BASE_URL = "http://localhost" . self::BASE_PATH;

    //Configurazioni Immagini
    public const UPLOAD_POST_DIR = "/assets/post/";
    public const UPLOAD_AVATAR_DIR = "/assets/avatar/";
    public const ABSOLUTE_UPLOAD_POST_DIR = __DIR__ . "/../../assets/post/";
    
    // Configurazioni DB
    public const DB_SERVERNAME = "localhost";
    public const DB_USERNAME = "root";
    public const DB_PASSWORD = "";
    public const DB_DBNAME = "UniRed";
    public const DB_PORT = 3306;
}
