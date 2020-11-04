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

     public function isLoggedUser():bool
     { 
          return array_key_exists('auth', $_SESSION) ? true : false ;
     }     

     public function setAuth(Users $users) 
     {
          $_SESSION['auth']['email'] = $users->getEmail();
          $_SESSION['auth']['token'] = $users->getToken();
          $_SESSION['auth']['firstname'] = $users->getFirstname();
          $_SESSION['auth']['lastname'] = $users->getLastname();
          $_SESSION['auth']['chapo'] = $users->getChapo();
          $_SESSION['auth']['users_id'] = $users->getId();
          $_SESSION['auth']['role'] = $users->getRoles();
          $_SESSION['auth']['last_connection'] = $users->getLastConnection();
     }

     /**
      * Get logged user
      * @return Users 
      */
     public function getLoggedUser():Users 
     {
          return new Users($this->get('auth'));
     }

}