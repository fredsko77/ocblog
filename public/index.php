<?php

// Prevent Session Hijacking
ini_set('session.cookie_httponly', true);

session_start();

require '../vendor/autoload.php';
require '../functions.php';
require '../config/routes.php';

use App\Router\Router;

(new Router($routes))->match();