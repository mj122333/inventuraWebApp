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
    "home" => "home.php",
    "profile" => "profile.php",
    "admin" => array(
        "test" => "test.php"
    ),
    "asd" => array(
        "test" => "test.php"
        
    ),
    "login" => "login.php",
    "logout" => "logout.php",
    "register" => "register.php",
    "delete_items" => "delete_items.php",
    "404" => "404.php"
];


print_r($_GET['route'] . "<br>");
$url = split_url($_GET['route']);
print_r($url);
exit;
function return_route($prev, $routes, $url)
{
    foreach ($url as $part) {
        if (array_key_exists($part, $routes)) {
            if (is_array($routes[$part]) && count($url) == 1) {
                return $part . ".php";
            } else if (is_array($routes[$part])) {
                $prev = array_shift($url);
                return return_route($prev, $routes[$part], $url);
            } else {
                return $routes[$part];
            }
        } else {
            return "404.php";
        }
    }
}

if (isset($_COOKIE["sessionid"]) || $route == "login" || $route == "register") { // TODO provjeriti ako je cookie ispravan
    require_once return_route($url[0], $routes, $url);
} else {
    require_once "login.php";
}




// if (isset($_COOKIE["sessionid"]) || $route == "login" || $route == "register") { // TODO provjeriti ako je cookie ispravan
//     // if (true) {
//     if (array_key_exists($route, $routes)) {
//         if (is_array($routes[$route])) {
//         } else {
//             require_once $routes[$route];
//         }
//     } else {
//         header("Location: 404.html");
//         exit;
//     }
// } else {
//     require_once "login.php";
//     // header("Location: login");
// }
