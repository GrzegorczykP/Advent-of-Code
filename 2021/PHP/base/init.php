<?php

spl_autoload_register(static function ($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    if (file_exists($className . '.php')) {
        require_once $className . '.php';
        return true;
    }
    return false;
});

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../base/BaseAssignment.php';