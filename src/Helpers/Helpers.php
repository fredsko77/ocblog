<?php 

namespace App\Helpers;

use App\Entity\Comments;
use App\Entity\Posts;
use App\Entity\Users;
use App\Services\Session;

class Helpers
{
     public function __construct(){}

     /**
     * getMethod
     * @param  string $str
     * @return string
     */
     public static function getMethod(string $str):string 
     {
          $needle = '_';
          $method = "";
          if (preg_match( "#{$needle}#", $str) ){
               $array = preg_split("#{$needle}#", $str);
               if ( is_array($array) ) {
                    foreach ($array as $k => $v) {
                         $method .= ucfirst($v);
                    }
               }
               return $method;
          } 
          return ucfirst($str);
     }

     /**
      * Transform string in slug
      * @param string $str
      * @return string
      */
     public static function generateSlug(string $str) 
     {
          $str = trim($str);
          $str = trim(skip_accents($str));
          return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $str ) );
     }

     /**
      * Put needle in a string
      * @param string $separator
      * @param array $array
      * @return string
      */
     public static function putBetween(string $separator, array $array): string
     {
          $str = "";
          if ( is_array($array) )
          {
               foreach($array as $k => $v):
                    $str .= $k === 0 ? $v : " {$separator} {$v}";
               endforeach;
          }
          return $str;
     }

     /**
      * Put needle before string
      * @param string $separator
      * @param array $array
      * @return string
      */
     public static function putBefore(string $separator, array $array):string
     {
          $str = "";
          if ( is_array($array) )
          {
               foreach($array as $k => $v):
                    $str .= "{$separator}{$v}";
               endforeach;
          }
          return $str;
     }

     /**
      * Transform keys for PDO::execute()
      * @param array $values
      * @return array
      */
     public static function transformKeys(array $values):array 
     {
          $execute = [];
          
          foreach ($values as $k => $v) 
          {          
               $execute[":{$k}"] = $v;
          }
          return $execute;
     }

     /**
      * Get URL params 
      * @param array $path
      * @param array $url
      * @return array
      */
     public static function getUrlParams(array $path, array $url):array 
     {
          $params = [];
          foreach ($path as $key => $value) {
               if ( preg_match("#:#", $value) ) {
                    $params[preg_replace('#:#', "", $value)] = $url[$key];
               }
          }
          return $params;
     } 

     /**
      * Get URL pattern
      * @param string $path
      * @return string
      */
     public static function getUrlPattern(string $path):string
     {
          $patterns = [
               'slug' => '([\/A-Za-z0-9\-]+)',
               'id' => '([0-9]+)',
               's' => '([\w]+)'
          ]; 
          $explode_path = explode('/', trim($path, '/'));
          $parts = [];
          foreach ( $explode_path as $k => $p) {
               if ( preg_match("#:#", $p) ) {
                    $parts[] = $patterns[preg_replace('#:#', '', $p)] ;
               } else {
                    $parts[] = $p;
               }
          }
          $pattern = "#^" . self::putBefore('/', $parts) . "$#";
          return $pattern;
     }
     
     /**
      * Check if every field is filled
      * @param array $data
      * @return boolean
      */
     public static function checkFieldsSet(array $data = []):bool
     {
          foreach($data as $k => $v) {
               if ( $v === '' || $v === NULL ) return false;
          }
          return true;
     }

     /**
      * Sanitize input data
      * @param array $data
      * @return array
      */
     public static function sanitize(array $data = []):array
     {
          $sanitize = [];
          $tags = ['a', 'article', 'aside', 'b', 'br', 'div', 'em', 'font', 'hr', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'i', 'img', 'li', 'ol','p', 'pre', 'section', 'small', 'strong', 'sub', 'sup', 'u', 'ul'];
          foreach ($data as $k => $v) {
               $v = trim($v);
               $v = strip_tags($v, array_to_string($tags));
               $v = str_replace('\'', "&#39;", $v);
               $sanitize[$k] = htmlspecialchars(trim($v), ENT_IGNORE, "UTF-8" );
          }
          return $sanitize;
     }

     /**
      * Check if csrf_token is valid
      * @param string $token
      * @return void
      */
     public static function checkCsrfToken(string $token) 
     {
          $session_csrf = (new Session)->get('csrf_token');
          return $session_csrf && $session_csrf === $token ? true : false;
     }

     public static function commentsStatus()
     {
          return Comments::STATUS;
     }

     public static function postsStatus()
     {
          return Posts::STATUS;
     }

     public static function checkExtension(string $file_name, array $allowed_extensions) 
     {
          $file_extension = explode('.', $file_name)[1];
          return in_array($file_extension, $allowed_extensions);
     }

     public static function getWriters(array $users = []): array
     {
          $data = [];
          foreach($users as $key => $user) {
               $data[$user->getId()] = "{$user->getFirstname()} {$user->getLastname()}";
          }
          return $data;
     }

}