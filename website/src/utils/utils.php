<?php

class Utils{
    //Classe per gestire i dati in SESSIONE

    public const ROLE_ADMIN = "admin";
    public const ROLE_USER = "user";

    public static function registerLoggedUser($user){
        $_SESSION["userid"] = $user["userid"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["typology"];
        $_SESSION["avatar"] = $user["avatar"];
    }

    public static function isUserLoggedIn(){
        return !empty($_SESSION["userid"]);
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
