<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

if(!isset($_SESSION)){
    session_start();
}

$router = new \Core\Tools\Router();
//main
$router->get('/', 'LoginController@loginView');

//register
$router->get('/register', 'RegisterController@registerView');
$router->post('/register-now', 'RegisterController@register');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);