<?php

return $routes = [
     'GET' => [
          'home' => [
               'action' => "App\Controller\HomeController@index",
               'path' => "/",
          ],
          'about' => [
               'action' => "App\Controller\HomeController@about",
               'path' => "/a-propos"
          ],
          'contact' => [
               'action' => "App\Controller\HomeController@contact",
               'path' => "/nous-contacter"
          ],
          'blog' => [
               'action' => "App\Controller\BlogController@index",
               'path' => "/blog"
          ],
          'blog.show' => [
               'action' => "App\Controller\BlogController@show",
               'path' => "/blog/posts/:slug/:id"
          ],
          'blog.paginate' => [
               'action' => "App\Controller\BlogController@index",
               'path' => "/blog/post/page/:id"
          ],
          '404' => [
               'action' => "App\Controller\BlogController@notFound",
               'path' => "/404"
          ],
          'resume' => [
               'action' => "App\Controller\HomeController@resume",
               'path' => "/my-resume"
          ],
          'auth.login' => [
               'action' => "App\Controller\AuthController@login",
               'path' => "/auth/login"
          ],
          'auth.register' => [
               'action' => "App\Controller\AuthController@register",
               'path' => "/auth/register"
          ],
          'auth.forget' => [
               'action' => "App\Controller\AuthController@register",
               'path' => "/auth/mot-de-passe-oublie"
          ],
          'admin' => [
               'action' => "App\Controller\Admin\DashboardController@index",
               'path' => "/admin/dashboard"
          ]
     ],
     'POST' => [
          'post-contact' => [
               'action' => "App\Controller\HomeController@postContact",
               'path' => "/post-contact"
          ],
          'auth.authenticate' => [
               'action' => "App\Controller\AuthController@authenticate",
               'path' => "/auth/authenticate"
          ]
     ],
     'PUT' => [], 
     'DELETE' => []
];