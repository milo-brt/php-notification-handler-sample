<?php

    // composer autoloader
    require 'vendor/autoload.php';

    // project loader
    require 'Controllers/NotificationController.php';
    require 'Controllers/AuthenticationController.php';
    require 'Models/FileStoreModel.php';

    // router
    $router = new AltoRouter();
    $controller = new Controllers\NotificationController();
    $auth = new Controllers\AuthenticationController();
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    
    $dotenv->load();
    
    $router->map('GET', '/', 'get');
    $router->map('POST', '/', 'post');
    $router->map('GET', '/login', 'getAuth');
    $router->map('POST', '/', 'postAuth');

    $match = $router->match();
    
    if(is_array($match)) {
        list($view, $data) = $controller->{$match['target']}($match['params']);
        if($view != null)
            require __DIR__ . "/Views/$view.phtml";    
    }

?>