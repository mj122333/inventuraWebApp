<?php
define('DB_SERVERNAME', 'localhost');
define('DB_USERNAME', 'vito');
define('DB_PASSWORD', 'micko');
define('DB_NAME', 'inventura');

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
