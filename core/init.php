<?php

ob_start();

date_default_timezone_set("Asia/Kolkata"); // Corrected this line

session_start();

define('WWW_ROOT', 'http://localhost/presentation/');

require_once(__DIR__ . '/config.php');


require_once (__DIR__.'/functions.php');

spl_autoload_register(function ($className) {
    require_once "classes/{$className}.php";
});


$account = new Account();
$LoadFromUser = new User(); 

