<?php


session_start();
require_once "config/config.php";
require_once "mysqldb.class.php";
require_once "functions.php";

// dd($_SERVER["REQUEST_URI"]);


$url = parse_url($_SERVER["REQUEST_URI"])["path"];
// $query = parse_url($_SERVER["REQUEST_URI"])["query"];
$url = short_url($url);
// echo "<img src='barcodes/code_165197697230.png' />";
// dd(parse_url($_SERVER["REQUEST_URI"]));


// dd($url);

$db = new MySQLDB();


// $route = isset($_GET["route"]) ? split_url($_GET["route"])[0] : "home";
// $route = isset($_GET["route"]) ? $_GET["route"] : "home";

$route = split_url($url)[0] != "" ? split_url($url)[0] : "home" ;

$routes = [
    "home" => "controllers" . DS . "homecontroller.php", // ima kontroller
    "profile" => "controllers" . DS . "profilecontroller.php", // ima kontroller
    "admin" => "controllers" . DS . "admincontroller.php", // ima kontroller
    "admin/ucionice" => "ucionice.php",
    "login" => "controllers" . DS . "logincontroller.php", // ima kontroller
    "register" => "controllers" . DS . "registercontroller.php", // ima kontroller
    "logout" => "views/logout.php",
    "register" => "register.php",
    "delete_items" => "delete_items.php",
    "404" => "views/404.php"
];



// if (isset($_COOKIE["sessionid"]) || $route == "login" || $route == "register") { // TODO provjeriti ako je cookie ispravan
if (isset($_COOKIE["sessionid"])) { // TODO provjeriti ako je cookie ispravan
    $valid_cookie = $db->select_one("SELECT * FROM session_cookies WHERE token = ?", array($_COOKIE["sessionid"]));
    echo $valid_cookie['row_count'] . " ";
    if ($valid_cookie['row_count'] == 1) {
        echo "JEDAN" . " ";
        if (array_key_exists($route, $routes)) {
            require_once $routes[$route];
        } else {
            require_once "views/404.php"; // TODO response code
        }
    } else {
        require_once "controllers/logincontroller.php";
    }
} else {
    require_once "controllers/logincontroller.php";
}
