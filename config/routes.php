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
          'auth.logout' => [
               'action' => "App\Controller\AuthController@logout",
               'path' => "/auth/logout"
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
          'auth.reset.password' => [
               'action' => "App\Controller\AuthController@reset",
               'path' => "/auth/reset-password/:s/user"
          ],
          'admin' => [
               'action' => "App\Controller\Admin\DashboardController@index",
               'path' => "/admin/dashboard"
          ],
          'admin.posts' => [
               'action' => "App\Controller\Admin\AdminPostsController@index",
               'path' => "/admin/posts"
          ],
          'admin.posts.edit' => [
               'action' => "App\Controller\Admin\AdminPostsController@edit",
               'path' => "/admin/posts/:id/edit"
          ],          
          'admin.posts.create' => [
               'action' => "App\Controller\Admin\AdminPostsController@create",
               'path' => "/admin/posts/create"
          ],
          'admin.categories' => [
               'action' => "App\Controller\Admin\AdminCategoriesController@index",
               'path' => "/admin/posts/categories"
          ],
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
          'auth.password.token' => [
               'action' => "App\Controller\AuthController@sendPasswordToken",
               'path' => "/auth/forget-password"
          ],
          'admin.posts.store' => [
               'action' => "App\Controller\Admin\AdminPostsController@store",
               'path' => "/admin/posts/create"
          ],
          'admin.posts.update' => [
               'action' => "App\Controller\Admin\AdminPostsController@update",
               'path' => '/admin/posts/:id/update'
          ],
          'admin.categories.store' => [
               'action' => "App\Controller\Admin\AdminCategoriesController@store",
               'path' => "/admin/categories/create"
          ],
     ],
     'PUT' => [
          'admin.categories.update' => [
               'action' => "App\Controller\Admin\AdminCategoriesController@update",
               'path' => "/admin/categories/:id/update"
          ],
     ], 
     'DELETE' => [
          'admin.posts.delete' => [
               'action' => "App\Controller\Admin\AdminPostsController@delete",
               'path' => "/admin/posts/:id/delete"
          ],
          'admin.categories.delete' => [
               'action' => "App\Controller\Admin\AdminCategoriesController@delete",
               'path' => "/admin/categories/:id/delete"
          ],
     ]
];