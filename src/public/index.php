<?php

$autoloader = function (string $className) {
    $modifiedClassName = str_replace('\\', '/', $className);
    $path = __DIR__ . "/../$modifiedClassName.php";

    if (file_exists($path)) {
        require_once $path;
        return true;
    }
    return false;
};

spl_autoload_register($autoloader);

$app = new App();
$app->run();




