<?php 

namespace App\Entity;

use App\Helpers\Helpers;
use App\Model\PostsModel;

class Uploads 
{

     private $id;
     private $path;
     private $type;
     private $created_at;
     private $posts_id;
     private $users_id;

     /**
      * __construct
      *
      * @param  mixed $data
      *
      * @return void
     */
     public function __construct( array $data )
     {
         $this->_hydrate($data);
     }
 
     /**
      * _hydrate
      *
      * @param  mixed $data
      *
      * @return void
     */
     public function _hydrate( array $data )
     {
          foreach ($data as $k => $d):
               $method = 'set' . Helpers::getMethod($k);
               method_exists($this, $method) ? $this->$method($d) : null;
          endforeach;
     }
 
 
     /**
      * Get the value of id
      */ 
     public function getId()
     {
          return $this->id;
     }

     /**
      * Set the value of id
      *
      * @return  self
      */ 
     public function setId($id)
     {
          $this->id = $id;
          return $this;
     }


     /**
      * Get the value of path
      */ 
     public function getPath()
     {
          return $this->path;
     }

     /**
      * Set the value of path
      *
      * @return  self
      */ 
     public function setPath($path)
     {
          $this->path = $path;
          return $this;
     }

     /**
      * Get the value of type
     */ 
     public function getType()
     {
          return $this->type;
     }

     /**
      * Set the value of type
      *
      * @return  self
     */ 
     public function setType($type)
     {
          $this->type = $type;
          return $this;
     }

     /**
      * Get the value of created_at
     */ 
     public function getCreatedAt()
     {
          return $this->created_at;
     }

     /**
      * Set the value of created_at
      *
      * @return  self
     */ 
     public function setCreatedAt($created_at)
     {
          $this->created_at = $created_at;
          return $this;
     }

     /**
      * Get the value of users_id
     */ 
     public function getUsersId()
     {
          return $this->users_id;
     }

     /**
      * Set the value of users_id
      *
      * @return  self
     */ 
     public function setUsersId($users_id)
     {
          $this->users_id = $users_id;
          return $this;
     }

     /**
      * Get the value of posts_id
     */ 
     public function getPostsId()
     {          
          return (new PostsModel)->find($this->posts_id);
     }

     /**
      * Set the value of posts_id
      * @return  self
     */ 
     public function setPostsId($posts_id)
     {
          $this->posts_id = $posts_id;
          return $this;
     }

     // public static function  
     
}