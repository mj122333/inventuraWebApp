<?php
date_default_timezone_set('Europe/Zagreb');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$development = true;
if ($development) {
    define('APPFOLDER', 'inventura2');
    define('DB_SERVERNAME', 'localhost');
    define('DB_USERNAME', 'vito');
    define('DB_PASSWORD', 'micko');
    define('DB_NAME', 'inventura');
} else {
    define('APPFOLDER', 'inventura');
    define('DB_SERVERNAME', 'localhost');
    define('DB_USERNAME', 'studentadmin');
    define('DB_PASSWORD', 'dmKKXIm{r^v,');
    define('DB_NAME', 'zavrsni2024');
}
