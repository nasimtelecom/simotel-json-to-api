<?php

require("../vendor/autoload.php");

$router = new \Bramus\Router\Router;

require("../routes/web.php");

$router->run();