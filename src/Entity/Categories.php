<?php 

namespace App\Entity;

use App\Helpers\Helpers;

class Categories 
{

     private $id;
     private $category;
     private $description;
     private $slug;
     
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
      * Get the value of category
      */ 
     public function getCategory()
     {
          return $this->category;
     }

     /**
      * Set the value of category
      *
      * @return  self
      */ 
     public function setCategory($category)
     {
          $this->category = $category;

          return $this;
     }

     /**
      * Get the value of description
      */ 
     public function getDescription()
     {
          return $this->description;
     }

     /**
      * Set the value of description
      *
      * @return  self
      */ 
     public function setDescription($description)
     {
          $this->description = $description;

          return $this;
     }

     /**
      * Get the value of slug
      */ 
     public function getSlug()
     {
          return $this->slug;
     }

     /**
      * Set the value of slug
      *
      * @return  self
      */ 
     public function setSlug($slug)
     {
          $this->slug = $slug;

          return $this;
     }
}