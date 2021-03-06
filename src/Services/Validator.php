<?php 

namespace App\Services;

class Validator
{

     public function __construct()
     {       
          $this->config = require "../config/uploads.php";   
     }
     
     /**
      * email
      * @param  mixed $email
      * @return bool
      */
     public function email(string $email):bool
     {
          $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
          return preg_match($pattern, $email);
     }
     
     /**
      * Encrypt the password
      * @param string $password
      * @return string
     */
     public function encryptPassword(string $password):string
     {
          return password_hash($password, PASSWORD_ARGON2I);
     }

     /**
      * Check if the password match with pattern
      * @param string $password
      * @return boolean
     */
     public function password(string $password):bool
     {
          return preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]){8,}#',$password);
     }
     
     /**
      * pseudo
      * @param  mixed $pseudo
      * @return bool
      */
     public function pseudo(string $pseudo):bool
     {
          return strlen($pseudo) > 5 ? true : false;
     }

     public function size($size):bool 
     {
          if ($size > ( (int) $this->config->max_size_accepted * pow(1024, 2) ) ) {
               return false;
          }
          return true;
     }
     
     /**
      * Undocumented function
      * @param string $file_name
      * @return boolean
      */
     public function checkExtension(string $file_name):bool
     {
          $file_extension = strtolower(explode('.', $file_name)[1]);
          return in_array($file_extension, $this->config->file_accepted['image']);
     }

}