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
          'blog.paginate' => [
               'action' => "App\Controller\BlogController@index",
               'path' => "/blog/posts/page/:id"
          ],
          'blog.show' => [
               'action' => "App\Controller\BlogController@show",
               'path' => "/blog/posts/:id/:slug/"
          ],
          'not.found' => [
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
          'auth.confirm' => [
               'action' => "App\Controller\AuthController@confirm",
               'path' => "/auth/users/:s/confirm"
          ],
          'auth.forget' => [
               'action' => "App\Controller\AuthController@forget",
               'path' => "/auth/mot-de-passe-oublie"
          ],
          'auth.reset_password' => [
               'action' => "App\Controller\AuthController@reset",
               'path' => "/auth/reset-password/:s/user"
          ],
          'admin' => [
               'action' => "App\Controller\Admin\DashboardController@index",
               'path' => "/admin/dashboard"
          ]
     ],
     'POST' => [
          'home.contact' => [
               'action' => "App\Controller\HomeController@postContact",
               'path' => "/post-contact"
          ],
          'auth.store' => [
               'action' => "App\Controller\AuthController@store",
               'path' => "/auth/store"
          ],
          'auth.authenticate' => [
               'action' => "App\Controller\AuthController@authenticate",
               'path' => "/auth/authenticate"
          ],
          'auth.reset' => [
               'action' => "App\Controller\AuthController@changePassword",
               'path' => "/auth/reset-password"
          ],
          'user.confirm' => [
               'action' => "App\Controller\AuthController@changePassword",
               'path' => "/auth/complete-users-account"
          ],
          'auth.forget' => [
               'action' => "App\Controller\AuthController@sendPasswordToken",
               'path' => "/auth/forget-password"
          ]
     ],
     'PUT' => [], 
     'DELETE' => []
];