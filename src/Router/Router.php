<?php 

namespace App\Router;

use App\Helpers\Helpers;
use App\Services\Request;
use App\Controller\BlogController;

class Router 
{

     private $routes;
     private $url = "";
     private $params;
     private $path;
     private $action;
     private $request;

     public function __construct(array $routes)
     {
          $this->routes = $routes;
          $this->request = new Request();
     }

     public function match()
     {          
          $this->url = $this->request->server('REQUEST_URI');
          foreach ( $this->routes[$this->request->server('REQUEST_METHOD')] as $k => $v ) {
               if ( preg_match(Helpers::getUrlPattern($v["path"]), $this->url) ) {
                    $this->path = $v["path"];
                    $this->action = $v["action"];
                    $this->params = Helpers::getUrlParams( explode('/', $this->path), explode('/', $this->url) );
                    return $this->execute();
               }
          }
          // echo "<p>This <b style='color:red;'>'{$this->request->server('REQUEST_URI')}'</b> is not valid.</p><a href='/'> Retourner à la page d'accueil </a>";
          return (new BlogController())->notFound();
     }

     public function execute()
     {
          $values = explode("@", $this->action);
          $controller = new $values[0]();
          $method = $values[1];
          
          return isset($this->params) ? $controller->$method($this->params) : $controller->$method(); 
     }

}