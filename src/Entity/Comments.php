<?php 

namespace App\Entity;

use App\Helpers\Helpers;
use App\Model\UsersModel;
use App\Model\PostsModel;

class Comments 
{

     private $id;
     private $writer;
     private $content;
     private $status;
     private $created_at;
     private $post_id;

     const STATUS = ["to_validate" => "A valider", "validated" => "Validé"];

     /**
      * __construct
      * @param  mixed $data
      * @return void
      */
     public function __construct( array $data )
     {
         $this->_hydrate($data);
     }
 
     /**
      * _hydrate
      * @param  mixed $data
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
      * Get the value of writer
      */ 
     public function getWriter()
     {          
          return (new UsersModel())->find($this->writer);
     }

     /**
      * Set the value of writer
      *
      * @return  self
      */ 
     public function setWriter($writer)
     {
          $this->writer = $writer;

          return $this;
     }

     /**
      * Get the value of content
      */ 
     public function getContent()
     {
          return $this->content;
     }

     /**
      * Set the value of content
      *
      * @return  self
      */ 
     public function setContent($content)
     {
          $this->content = $content;

          return $this;
     }

     /**
      * Get the value of status
      */ 
     public function getStatus()
     {
          return $this->status;
     }

     /**
      * Set the value of status
      *
      * @return  self
      */ 
     public function setStatus($status)
     {
          $this->status = $status;

          return $this;
     }

     /**
      * Get the value of post_id
      */ 
     public function getPostId()
     {
          return $this->post_id;
     }

     /**
      * Set the value of post_id
      *
      * @return  self
      */ 
     public function setPostId($post_id)
     {
          $this->post_id = $post_id;

          return $this;
     }

     public function getPost()
     {
          return (new PostsModel())->find($this->getPostId(), Posts::class); 
     }

}