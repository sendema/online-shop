<?php

require_once './../View/App.php';

/*$autoloader = function (string $className) {
    require_once __DIR__ . "/../className.php";
};

spl_autoload_register($autoloader);*/

$app = new App();
$app->run();



