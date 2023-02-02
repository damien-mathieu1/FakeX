<?php

use App\Fakex\controller\ControllerDefault;
use App\Fakex\controller\ControllerModele;
use App\Fakex\Lib\Psr4AutoloaderClass;

require_once __DIR__ . '/../src/lib/Psr4AutoloaderClass.php';

// Instanciate the loader
$loader = new Psr4AutoloaderClass();

// Register the base Directories for the name prefix

$loader ->addNamespace('App\Fakex', __DIR__.'/../src/');

// register the autoloader
$loader->register();


//On recupere l'action passée sur l'URL
if (isset($_GET['action'])){
    if (isset($_GET['controller'])){
        $action = $_GET['action'];
        $controller = $_GET['controller'];
        $controllerClassName = 'App\Fakex\controller\Controller'.ucfirst($controller);
        if (!class_exists($controllerClassName)){
            $action = 'error';
            ControllerDefault::$action();
        }
        else {
            $controllerClassName::$action();
        }
    }
    else{
        $action = 'error';
        ControllerDefault::$action();
    }
}

else{
    $action = 'accueil';
    ControllerDefault::$action();
}

/*
$controller = $_GET['controller'] ?? 'standard';
$controllerClassName = "App\Fakex\controller\Controller".ucfirst($controller);

if(class_exists($controllerClassName)){
    $action = $_GET['action'] ?? 'readAll';
    $controllerClassName::$action();
}
*/