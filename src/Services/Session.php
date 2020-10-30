<?php 

namespace App\Services;

use App\Entity\Users;

class Session
{

     public function __construct() {}
     
     /**
      * Return a session data by key
      * @param string $key
      * @return mixed
     */
     public function get(string $key)
     {
          return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
     } 
 
     /**
      * Set a session data by key
      * @param string $key
      * @return mixed
     */
     public function set(string $key, $value)
     {
          $_SESSION[$key] = $value;
     }

     public function unset(string $key)
     {
          unset($_SESSION[$key]);
     }

     public function all():array
     {
          return $_SESSION;
     }

     public function getUser()
     { 
          return array_key_exists('user', $_SESSION) ? $_SESSION['user'] : null ;
     }     

     /**
      * Get logged user
      * @return Users 
      */
     public function getLoggedUser():Users 
     {
          return new Users([]);
     }

}