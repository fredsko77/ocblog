<?php 

namespace App\Entity;

use \DateTime;
use App\Entity\Users;
use App\Helpers\Helpers;
use App\Model\UsersModel;
use App\Model\UploadsModel;
use App\Model\CommentsModel;
use App\Model\CategoriesModel;

class Posts 
{

     private $id;
     private $category_id;
     private $writer;
     private $title;
     private $content;
     private $image;
     private $slug;
     private $chapo;
     private $status;
     private $updated_at;
     private $created_at;

     public const STATUS = ["draft" => "Brouillon", "published" => "Publié"];

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
      * Get the value of writer
      */ 
     public function getWriter()
     {
          return $this->writer !== null ? (new UsersModel())->find((int) $this->writer, Users::class) : $this->writer;
     }

     /**
      * Set the value of writer
      * @return  self
      */ 
     public function setWriter($writer)
     {
          $this->writer = $writer;
          return $this;
     }

     /**
      * Get the value of created_at
      */ 
     public function getCreatedAt()
     {
          return (new DateTime($this->created_at) )->format('Y-m-d à H:m');
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
      * Get the value of category_id
      */ 
     public function getCategoryId()
     {
          return (new CategoriesModel)->find($this->category_id, Categories::class);
     }

     /**
      * Set the value of category_id
      *
      * @return  self
      */ 
     public function setCategoryId($category_id)
     {
          $this->category_id = $category_id;
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
          $this->status = array_key_exists($status, self::STATUS) ?  $status : 'draft';
          return $this;
     }

     /**
      * Get the value of image
      */ 
     public function getImage()
     {
          return (new UploadsModel)->findPath((int) $this->image);
     }

     /**
      * Set the value of image
      *
      * @return  self
      */ 
     public function setImage($image)
     {
          $this->image = $image;

          return $this;
     }

     public function getComments()
     {
          return (new CommentsModel)->getPostComments($this->getId());
     }
     
}