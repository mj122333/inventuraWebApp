<?php

function login_with_id($id) // prijava putem id-a
{
    global $db;

    $user_data = $db->select_one("SELECT * FROM vl_users WHERE id=?", array($id))["result"];
    foreach ($user_data as $key => $value) {
        // echo $key . " => " . $value . "<br>";
        if ($key != "password") {
            $_SESSION[$key] = $value;
        }
    }
}

function login_with_cookie($cookie) // prijava putem cookia
{
    global $db;

    $user_id = $db->select_one("SELECT * FROM vl_session_cookies WHERE token=?", array($cookie))["result"]["user_id"];

    $user_data = $db->select_one("SELECT * FROM vl_users WHERE id=?", array($user_id))["result"];
    foreach ($user_data as $key => $value) {
        // echo $key . " => " . $value . "<br>";
        if ($key != "password") {
            $_SESSION[$key] = $value;
        }
    }
}

function calculateEAN13CheckDigit($digits) // za racunanje kontrolne znamenke ean13 barkoda
{
    // Ensure that the input has exactly 12 digits
    if (strlen($digits) !== 12) {
        throw new InvalidArgumentException('EAN-13 barcode must have 12 digits.');
    }

    // Calculate the sum of alternating digits
    $evenSum = $oddSum = 0;
    for ($i = 0; $i < 12; $i++) {
        $digit = (int)$digits[$i];
        if ($i % 2 === 0) {
            $oddSum += $digit;
        } else {
            $evenSum += $digit;
        }
    }

    // Calculate the total sum
    $totalSum = $oddSum + ($evenSum * 3);

    // Find the smallest multiple of 10 that is greater than or equal to the total sum
    $nextTenMultiple = ceil($totalSum / 10) * 10;

    // Calculate the check digit
    $checkDigit = $nextTenMultiple - $totalSum;

    return $checkDigit;
}

function translate_route($r) // prijevod ruta na hrvatski
{
    $routes = [
        "home" => "početna",
        "profile" => "profil",
        "admin" => "admin",
        "login" => "prijava",
        "register" => "registracija",
        "logout" => "odjava",
        "js_upload" => "izbriši stavke",
        "404" => "404",
        "403" => "403",
        "admin/js_upload" => "admin/izbriši stavke",
        "importdb" => "import DB",
        "upload" => "upload",
        "bf" => "bf",
        "scan" => "Sken"
    ];

    if (array_key_exists($r, $routes)) {
        return ucfirst($routes[$r]);
    }
    return $r;
}

function short_url($url) // krati url, makne prvi dio
{
    $url = split_url($url);
    array_shift($url); // makne "/"
    array_shift($url); // makne "inventura"
    return implode("/", $url);
}

function split_url($url) // razdovaja url
{
    return explode("/", $url);
}

function dd($var) // funkcija za debugiranje
{
    print_r($var);
    die;
}

function return_route($prev, $routes, $url) // TODO provjeriti ako radi
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

function check_login_cookie() // provjerava ako je login cookie i valjan i pokrece se login sa cookijem
{
    global $db;

    $valid_cookie = $db->select_one("SELECT * FROM vl_session_cookies WHERE token = ?", array($_COOKIE["sessionid"]));

    if ($valid_cookie['row_count'] == 1) {
        login_with_cookie($valid_cookie["result"]["token"]);
    }

    return $valid_cookie['row_count'] == 1;
}

function check_admin_with_cookie() // TODO provjeriti
{
}


function get($param)
{
    if (isset($_GET[$param])) {
        return $_GET[$param];
    }

    return NULL;
}

function post($param)
{
    if (isset($_POST[$param])) {
        return $_POST[$param];
    }

    return NULL;
}
