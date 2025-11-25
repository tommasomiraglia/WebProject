<?php

class Utils{
    //Classe per gestire i dati in SESSIONE

    public const ROLE_ADMIN = "admin";
    public const ROLE_USER = "utente";

    public static function registerLoggedUser($user){
        $_SESSION["userid"] = $user["userid"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["typology"];
    }

    public static function isUserLoggedIn(){
        return !empty($_SESSION["username"]);
    }

    public static function redirect($path){
        $full_path = Settings::BASE_URL . $path;
        header("Location:" . $full_path);
        exit;
    }

    public static function isAdmin(){
        return $_SESSION["role"] === self::ROLE_ADMIN;
    }

}
