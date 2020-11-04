<?php 

namespace App\Entity;

use \DateTime;
use App\Helpers\Helpers;
use App\Model\UsersModel;

class Posts 
{

     private $id;
     private $author;
     private $title;
     private $chapo;
     private $slug;
     private $content;
     private $updated_at;
     private $created_at;
     private $categories_id;

    /**
     * __construct
     *
     * @param mixed $data
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
      * Get the value of updated_at
      */ 
     public function getUpdatedAt()
     {
          return $this->updated_at;
     }

     /**
      * Set the value of updated_at
      *
      * @return  self
      */ 
     public function setUpdatedAt($updated_at)
     {
          $this->updated_at = $updated_at;
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

     /**
      * Get the value of chapo
      */ 
     public function getChapo()
     {
          return $this->chapo;
     }

     /**
      * Set the value of chapo
      *
      * @return  self
      */ 
     public function setChapo($chapo)
     {
          $this->chapo = $chapo;
          return $this;
     }

     /**
      * Get the value of title
      */ 
     public function getTitle()
     {
          return $this->title;
     }

     /**
      * Set the value of title
      *
      * @return  self
      */ 
     public function setTitle($title)
     {
          $this->title = $title;
          return $this;
     }

     /**
      * Get the value of author
      */ 
     public function getAuthor()
     {
          return (new UsersModel())->find($this->author);
     }

     /**
      * Set the value of author
      *
      * @return  self
      */ 
     public function setAuthor($author)
     {
          $this->author = $author;
          return $this;
     }

     /**
      * Get the value of created_at
      */ 
     public function getCreatedAt()
     {
          return (new DateTime($this->created_at) )->format('d/m/Y à H:m');
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
      * Get the value of categories_id
      */ 
     public function getCategoriesId()
     {
          // (new CategoriesModel)->find($this->categories_id)
          return $this->categories_id;
     }

     /**
      * Set the value of categories_id
      *
      * @return  self
      */ 
     public function setCategoriesId($categories_id)
     {
          $this->categories_id = $categories_id;
          return $this;
     }
}