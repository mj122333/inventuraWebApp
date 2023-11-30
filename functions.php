<?php

function short_url($url)
{
    $url = split_url($url);
    array_shift($url); // makne "/"
    array_shift($url); // makne "inventura"
    return implode("/", $url);
}

function split_url($url)
{
    return explode("/", $url);
}

function dd($var)
{
    print_r($var);
    die;
}

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
