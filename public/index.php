<?php

require '../functions.php';

// Prevent Session Hijacking
ini_set('session.cookie_httponly', true);

setlocale(LC_TIME, "fr_FR");

init_session();

require '../vendor/autoload.php';
require '../config/routes.php';

use App\Router\Router;

(new Router($routes))->match();