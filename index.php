<?php
define('ROOT', dirname(__FILE__));

spl_autoload_register(function ($class_name) {

    $array_paths = [
        '/route/',
        '/model/',
        '/view/'
    ];

    foreach ($array_paths as $path_to_file) {

        $path = ROOT . $path_to_file . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }
});

$run = new Route();
$run->showForm();
