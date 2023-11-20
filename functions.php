<?php

function split_url($url)
{
   return explode("/", $url);
}

function dd($var)
{
   print_r($var);
   die;
}
