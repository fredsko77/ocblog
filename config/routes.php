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
               'path' => "/blog/posts/:id/:slug"
          ],          
          'blog.category' => [
               'action' => "App\Controller\BlogController@category",
               'path' => "/blog/category/:id/:slug"
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
          'auth.profile' => [
               'action' => "App\Controller\AuthController@profile",
               'path' => "/auth/profile"
          ],
          'auth.email.reset.confirm' => [
               'action' => 'App\Controller\AuthController@resetEmailConfirm',
               'path' => '/auth/reset/email/:s/:id'
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
          'admin.comments' => [
               'action' => "App\Controller\Admin\AdminCommentsController@index",
               'path' => "/admin/comments"
          ],
          'admin.contacts' => [
               'action' => "App\Controller\Admin\AdminContactsController@index",
               'path' => "/admin/contacts"
          ],
          'admin.users' => [
               'action' => "App\Controller\Admin\AdminUsersController@index",
               'path' => "/admin/users"
          ],
          'admin.users.create' => [
               'action' => "App\Controller\Admin\AdminUsersController@create",
               'path' => "/admin/users/create"
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
          'auth.password.token' => [
               'action' => "App\Controller\AuthController@sendPasswordToken",
               'path' => "/auth/forget-password"
          ],
          'auth.profile.change.password' => [
               'action' => 'App\Controller\AuthController@updatePassword',
               'path' => '/auth/change-password/:id'
          ],
          'auth.email.reset.send' => [
               'action' => 'App\Controller\AuthController@resetEmail',
               'path' => '/auth/reset/email/:id'
          ],
          'auth.profile.edit' => [
               'action' => 'App\Controller\AuthController@updateProfile',
               'path' => '/auth/profile/:id/edit'
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
          'blog.posts.comment.add' => [
               'action' => "App\Controller\BlogController@comment",
               'path' => "/blog/posts/:id/comment"
          ],
          'admin.users.store' => [
               'action' => 'App\Controller\Admin\AdminUsersController@store',
               'path' => '/admin/users/store',
          ],
     ],
     'PUT' => [
          'admin.categories.update' => [
               'action' => "App\Controller\Admin\AdminCategoriesController@update",
               'path' => "/admin/categories/:id/update"
          ],
          'admin.comments.edit' => [
               'action' => "App\Controller\Admin\AdminCommentsController@edit",
               'path' => "/admin/comments/:id/edit"
          ],
          'admin.contacts.edit' => [
               'action' => "App\Controller\Admin\AdminContactsController@read",
               'path' => "/admin/contacts/:id/edit"
          ],
          'admin.users.edit.role' => [
               'action' => 'App\Controller\Admin\AdminUsersController@editRole', 
               'path' => "/admin/users/:id/:s", 
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
          "admin.users.delete" => [
               'action' => "App\Controller\Admin\AdminUsersController@delete",
               "path" => "/admin/users/:id/delete",
          ],
          'auth.delete' => [
               'action' => "App\Controller\AuthController@delete",
               'path' => "/auth/:id/delete"
          ],
     ]
];