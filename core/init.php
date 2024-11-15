<?php

ob_start();

date_default_timezone_set("Asia/Kolkata"); // Corrected this line

session_start();

define('WWW_ROOT', 'http://localhost/presentation/');

require_once "core/functions.php";

spl_autoload_register(function($className) {
    require_once "classes/{$className}.php";
});