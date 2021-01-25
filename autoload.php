<?php


function my_app_autoloader($class)
{
    $root = 'app/';
    $prefix = 'App\\';

    // bỏ prefix
    $classWithoutPrefix = preg_replace('/^' . preg_quote($prefix) . '/', '', $class);
    // Thay thế \ thành /
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutPrefix) . '.php';


    $path = $root . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}

spl_autoload_register('my_app_autoloader');
