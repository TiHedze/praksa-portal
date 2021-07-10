<?php
    if(!isset($_REQUEST['rt']))
    {
        $controllerName = 'loginController';
        $action = 'index';
    }
    else
    {
        $uri = explode('/', $_REQUEST['rt']);
        $controllerName = $uri[0] . 'Controller';
        $action = $uri[1];
        print_r($uri);
    }

    if(!file_exists(__DIR__ . "/controller/" . $controllerName . '.php'))
    {
        notFound();
    }

    require_once __DIR__ . "/controller/" . $controllerName . '.php';

    if(!class_exists($controllerName) || !method_exists($controllerName, $action))
    {
        notFound();
    }

    $controller = new $controllerName();

    $controller->$action();
    exit(0);

    function notFound()
    {
        exit(0);
    }
?>