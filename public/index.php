<?php

session_start();
require_once "../config/config.php";
require_once "db_config.php";

$route = isset($_GET["route"]) ? $_GET["route"] : "home";

$routes = [
    "home" => "home.php",
    "profile" => "profile.php",
    "admin" => "admin.php",
    "login" => "login.php"
];

if (isset($_COOKIE["sessionid"]) || $route == "login") {
    if (array_key_exists($route, $routes)) {
        require_once $routes[$route];
    } else {
        header("Location: 404.html");
        exit;
    }
} else {
    require_once "login.php";
}
