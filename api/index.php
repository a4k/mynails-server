<?php

error_reporting(-1);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

$filename = '../application/Router.php';
require($filename);

$router = new Router(); // router contains regular php methods

header('Content-type: application/json; charset=utf-8'); // использование json ответа
// отправление ответа клиенту
echo json_encode($router->answer((object) $_GET)); // json encode transforms object to json
