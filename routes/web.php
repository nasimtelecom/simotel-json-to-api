<?php

$router->setNamespace('\App\Controller');

$router->get('/',"MainController@index");

new App\Controller\MainController;