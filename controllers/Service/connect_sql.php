<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'realweb');
    define('DB_PORT', 8889);

    $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);

    /* [MUTE NOTIFICATIONS] */
error_reporting(E_ALL & ~E_NOTICE);

/* [PATH] */
// Manually define the absolute path if you get path problems
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);
?>