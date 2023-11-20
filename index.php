<?php


session_start();
require_once "config/config.php";
require_once "mysqldb.class.php";
require_once "functions.php";

$db = new MySQLDB();


// $route = isset($_GET["route"]) ? split_url($_GET["route"])[0] : "home";
$route = isset($_GET["route"]) ? $_GET["route"] : "home";
// $db->mysql_error("ROUTE", $route);
$routes = [
    "home" => "controllers" . DS . "homecontroller.php", // ima kontroller
    "profile" => "controllers" . DS . "profilecontroller.php", // ima kontroller
    // "admin" => array(
    //     "test" => "test.php",
    //     "ucionice" => "ucionice.php",
    // ),
    // "admin" => "admin.php",
    "admin" => "controllers" . DS . "admincontroller.php", // ima kontroller
    "admin/ucionice" => "ucionice.php",
    "ucionice" => "ucionice.php",
    "login" => "controllers" . DS . "logincontroller.php", // ima kontroller
    "register" => "controllers" . DS . "registercontroller.php", // ima kontroller
    "logout" => "views/logout.php",
    "register" => "register.php",
    "delete_items" => "delete_items.php",
    "404" => "views/404.php"
];



// // print_r($_GET['route'] . "<br>");
// $url = split_url($route);
// print_r($url);
// // exit;
// function return_route($prev, $routes, $url)
// {
//     foreach ($url as $part) {
//         if (array_key_exists($part, $routes)) {
//             if (is_array($routes[$part]) && count($url) == 1) {
//                 return $part . ".php";
//             } else if (is_array($routes[$part])) {
//                 $prev = array_shift($url);
//                 return return_route($prev, $routes[$part], $url);
//             } else {
//                 return $routes[$part];
//             }
//         } else {
//             return "404.php";
//         }
//     }
// }

// if (isset($_COOKIE["sessionid"]) || $route == "login" || $route == "register") { // TODO provjeriti ako je cookie ispravan
//     require_once return_route($url[0], $routes, $url);
// } else {
//     require_once "login.php";
// }

// if (isset($_COOKIE["sessionid"]) || $route == "login" || $route == "register") { // TODO provjeriti ako je cookie ispravan
if (isset($_COOKIE["sessionid"])) { // TODO provjeriti ako je cookie ispravan

    if (array_key_exists($route, $routes)) {
        require_once $routes[$route];
    } else {
        require_once "views/404.php";
    }
} else {
    require_once "controllers/logincontroller.php";
}
