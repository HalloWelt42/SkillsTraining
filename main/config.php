<?php
    error_reporting(E_ERROR | E_PARSE);

    spl_autoload_register(function ($class) {
        $file = __DIR__ . '/cmd/' . $class . '.php';
        if (file_exists($file)) {
            require $file;
        }
    });

