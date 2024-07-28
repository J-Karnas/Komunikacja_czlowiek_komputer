<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

if(!isset($_SESSION)){
    session_start();
}

$router = new \Core\Tools\Router();
//main
$router->get('/', 'LoginController@loginView');
$router->post('/login-now', 'LoginController@login');

//manager
$router->get('/manager', 'ManagerController@managerView');

//user
$router->get('/user', 'UserController@userView');

//user
$router->get('/employee', 'EmployeeController@employeeView');
$router->post('/employee-now', 'EmployeeController@employeeAdd');
$router->post('/employee-edit', 'EmployeeController@employeeEdit');
$router->post('/employee-del', 'EmployeeController@employeeDel');
//logaut
$router->get('/logout', 'LoginController@logout');

$router->get('/unaut-access', 'AccessController@unautAccess');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);