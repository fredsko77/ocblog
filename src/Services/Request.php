<?php

namespace App\Services;

use App\Services\Session;

class Request
{

     public function __construct()
     {
          $this->session = new Session();
     }

     /**
      * @return array $_GET
     */
     public function getAll():array
     {
          return $_GET;
     }

     /**
      * Return an itme from $_GET
      * @param string $key
      * @return mixed
     */
     public function get(string $key) 
     {
          return array_key_exists($key, $_GET) ? $_GET[$key] : null;
     }

     /**
      * @return array $_POST
     */
     public function postAll():array
     {
          return $_POST;
     }

     /**
      * Return an itme from $_POST
      * @param string $key
      * @return mixed
      */
     public function post(string $key) 
     {
          return array_key_exists($key, $_POST) ? $_POST[$key] : null;
     }

     /**
      * @return array $_SERVER
     */
     public function serverAll():array
     {
          return $_SERVER;
     }

     /**
      * Return an itme from $_SERVER
      * @param string $key
      * @return mixed
     */
     public function server(string $key) 
     {
          return array_key_exists($key, $_SERVER) ? $_SERVER[$key] : null;
     }

     /**
      * Check if form is submitted
      * @return boolean
     */
     public function isSubmitted()
     {
          return $this->server('REQUEST_METHOD') === "POST" && count($_POST) > 0 ?  true : false;
     }

     /**
      * Return a request infos
      * @return void
     */
     public function getContent() {
          return file_get_contents("php://input");
     }

     /**
      * Check Authorization
      * @return boolean
      */
     public function checkAuthorization():bool
     {
          $headers = apache_request_headers();
          return array_key_exists('Authorization', $headers) && $headers['Authorization'] === $this->session->get('csrf_token') ? true : false;
     }

     public function putContent()
     {
          return fopen("php://input", "r");
     }
}