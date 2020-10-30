<?php

return $routes = [
     'GET' => [
          'home' => [
               'action' => "App\Controller\HomeController@index",
               'path' => "/",
          ],
          'blog' => [
               'action' => "App\Controller\BlogController@index",
               'path' => "/blog"
          ],
          '404' => [
               'action' => "App\Controller\BlogController@notFound",
               'path' => "/404"
          ]
     ],
     'POST' => [],
     'PUT' => [], 
     'DELETE' => []
];