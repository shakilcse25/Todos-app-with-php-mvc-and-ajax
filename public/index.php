<?php
    // defined('__ROOT__') or exit('No direct script access allowed');
    require_once('../vendor/autoload.php');
    define('ROOT', dirname(dirname(__FILE__)));

    define('HEADER', ROOT."\src\Views\inc\header.php");
    define('FOOTER', ROOT."\src\Views\inc\\footer.php");

    $db = new \Todos\Config\Database();
    $dispatch = new \Todos\Dispatcher();
    $dispatch->dispatch();
?>