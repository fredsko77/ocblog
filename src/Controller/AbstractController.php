<?php

namespace App\Controller;

use App\Helpers\Helpers;
use App\Services\Request;
use App\Services\Session;

abstract class AbstractController
{

     protected $session;

     public function __construct()
     {
          $this->session = new Session();
     }

     /**
      * Return a view
      * @param string $path
      * @param array $params
      * @return void
      */
     public function view(string $path, array $params = []) 
     {

          if ( $this->session->isLoggedUser() ) $params['user'] = $this->session->getLoggedUser();
          
          $params['request'] = new Request();
          
          $path = str_replace(".", "/", $path);
          
          ob_start();          
          
          $params = (object) $params; 
          
          require get_template("elements/header");
          require get_template($path);
          require get_template('elements/footer');
          
          $content = ob_get_clean();
          
          require get_template("layouts");
     }
     
     /**
      * Return a view
      * @param string $path
      * @param array $params
      * @return void
      */
      public function adminView(string $path, array $params = []) 
      {
           
          if ( $this->session->isLoggedUser() ) $params['user'] = $this->session->getLoggedUser();
          
          $params['request'] = new Request();

          if ( $params['user'] ) {
               $path = "users.not-allowed";
          }

          $path = str_replace(".", "/", $path);
          
          ob_start();          

          $params = (object) $params; 
          
          require get_template("elements/header-admin");
          require get_template($path);
          require get_template('elements/footer');

          $content = ob_get_clean();

          require get_template("layouts");
     }

     /**
      * Redirect to route
      * @param string $route
      * @return void
      */
     public function redirect(string $route = "/") 
     {
          return header("Location: {$route}");
     }

     /**
      * Send an Ajax response
      * @param array $data
      * @param integer $code
      * @return void
      */
     public function json(array $data, int $code = 200)
     {            
          header('Content-Type: application/json');
          http_response_code($code);      
          echo json_encode($data);
     }

}