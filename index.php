<?php
session_start();
require_once "config/config.php";
require_once "mysqldb.class.php";
require_once "functions.php";

$db = new MySQLDB();

$url = parse_url($_SERVER["REQUEST_URI"])["path"];
$url = short_url($url);
$route = split_url($url)[0] != "" ? split_url($url)[0] : "home";
$sub_route = isset(split_url($url)[1]) ? split_url($url)[1] : "";

$db->mysql_error("ROUTE", $route . DS . $sub_route);

$routes = [
    "home" => "controllers" . DS . "homecontroller.php", // ima kontroller
    "profile" => "controllers" . DS . "profilecontroller.php", // ima kontroller
    "admin" => "controllers" . DS . "admincontroller.php", // ima kontroller
    "login" => "controllers" . DS . "logincontroller.php", // ima kontroller
    "register" => "controllers" . DS . "registercontroller.php", // ima kontroller
    "scan" => "views" . DS . "scan.php", // TODO controller ?
    "logout" => "views/logout.php",
    "js_upload" => "js_upload.php",
    "404" => "views/404.php",
    "403" => "views/403.php",

    "admin/js_upload" => "js_upload.php",

    "importdb" => "importdb.php",
    "upload" => "upload.php",
    "api" => "api.php",

    "bf" => "bf.php",
];

if (array_key_exists($route . "/" . $sub_route, $routes)) {
    require_once $routes[$route . "/" . $sub_route];
    exit;
}

if ($route == "info") {
    phpinfo();
    exit;
}

if ($route == "login" || $route == "register") {
    require_once $routes[$route];
} elseif ($route == "upload") {
    require_once $routes["upload"];
} elseif ($route == "importdb") {
    require_once $routes["importdb"];
} elseif ($route == "bf") {
    require_once $routes["bf"];
} else {
    if (isset($_COOKIE["sessionid"])) {

        if (check_login_cookie()) {
            if (array_key_exists($route, $routes)) {
                require_once $routes[$route];
            } else {
                require_once "views/404.php";
            }
        } else {
            require_once "controllers/logincontroller.php";
        }
    } else {
        require_once "controllers/logincontroller.php";
    }
}
