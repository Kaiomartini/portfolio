<?php

define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);

function autoLoadNamespaces($className)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $file = ROOT_PATH . $path . '.php';
    if (is_file($file)) {
        require_once "$file";
    }
}

spl_autoload_register('autoLoadNamespaces');


