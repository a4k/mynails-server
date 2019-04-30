<?php

error_reporting(-1);

require_once '../application/Router.php';

$router = new Router(); // router contains regular php methods

header('Content-type: application/json'); // использование json ответа
// отправление ответа клиенту
echo json_encode($router->answer((object) $_GET)); // json encode transforms object to json
