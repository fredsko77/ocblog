<?php

namespace App\Entity;

use DateTime;
use App\Helpers\Helpers;
use App\Model\UploadsModel;

class Users 
{

     private $id;
     private $gender;
     private $firstname;
     private $lastname;
     private $pseudo;
     private $email;
     private $chapo;
     private $slug;
     private $position;
     private $image;
     private $password;
     private $confirm;
     private $token;
     private $role;
     private $last_connection;
     private $created_at;

     const ROLES = [
          'user' => 'Utilisateur',
          'admin' => 'Administrateur',
     ];

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
          return (int) $this->id;
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
      * Get the value of firstname
      */ 
     public function getFirstname()
     {
          return ucfirst($this->firstname);
     }

     /**
      * Set the value of firstname
      *
      * @return  self
      */ 
     public function setFirstname($firstname)
     {
          $this->firstname = $firstname;

          return $this;
     }

     /**
      * Get the value of lastname
      */ 
     public function getLastname()
     {
          return ucfirst($this->lastname);
     }

     /**
      * Set the value of lastname
      *
      * @return  self
      */ 
     public function setLastname($lastname)
     {
          $this->lastname = $lastname;

          return $this;
     }

     /**
      * Get the value of role
      */ 
     public function getRole()
     {
          return $this->role;
     }

     /**
      * Set the value of role
      *
      * @return  self
      */ 
     public function setRole($role)
     {
          $this->role = $role;

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
      * Get the value of confirm
      */ 
     public function getConfirm()
     {
          return $this->confirm;
     }

     /**
      * Set the value of confirm
      *
      * @return  self
      */ 
     public function setConfirm($confirm)
     {
          $this->confirm = $confirm;

          return $this;
     }

     /**
      * Get the value of token
      */ 
     public function getToken()
     {
          return $this->token;
     }

     /**
      * Set the value of token
      *
      * @return  self
      */ 
     public function setToken($token)
     {
          $this->token = $token;

          return $this;
     }

     /**
      * Get the value of email
      */ 
     public function getEmail()
     {
          return $this->email;
     }

     /**
      * Set the value of email
      *
      * @return  self
      */ 
     public function setEmail($email)
     {
          $this->email = $email;

          return $this;
     }

     /**
      * Get the value of password
      */ 
     public function getPassword()
     {
          return $this->password;
     }

     /**
      * Set the value of password
      *
      * @return  self
      */ 
     public function setPassword($password)
     {
          $this->password = $password;

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
      * Get the value of last_connection
      */ 
     public function getLastConnection()
     {
          return $this->last_connection;
     }

     /**
      * Set the value of last_connection
      *
      * @return  self
      */ 
     public function setLastConnection($last_connection)
     {
          $this->last_connection = $last_connection;
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

     /**
      * Get the value of gender
      */ 
     public function getGender()
     {
          return $this->gender;
     }

     /**
      * Set the value of gender
      *
      * @return  self
      */ 
     public function setGender($gender)
     {
          $this->gender = $gender;

          return $this;
     }

     /**
      * Get the value of pseudo
      */ 
     public function getPseudo()
     {
          return $this->pseudo;
     }

     /**
      * Set the value of pseudo
      *
      * @return  self
      */ 
     public function setPseudo($pseudo)
     {
          $this->pseudo = $pseudo;

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
      * Get the value of position
      */ 
     public function getPosition()
     {
          return $this->position;
     }

     /**
      * Set the value of position
      *
      * @return  self
      */ 
     public function setPosition($position)
     {
          $this->position = $position;

          return $this;
     }
}