<?php

//rozpoczęcie sesji
session_start();

//dołączenie pliku konfiguracyjnegp
require('../vendor/feelcom/config.php');

//przypisanie zapytania URL
$requestUrl = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

//var_dump($requestUrl);

$bootstrap = new Bootstrap($requestUrl);

$controller = $bootstrap->createController();

if ($controller) {

    $controller->executeAction();

}