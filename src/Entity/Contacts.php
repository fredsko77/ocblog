<?php 

namespace App\Entity;

use App\Helpers\Helpers;

class Contacts 
{

     private $id;
     private $firstname;
     private $lastname;
     private $email;
     private $object;
     private $message;
     private $status;

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
      * Get the value of firstname
      */ 
     public function getFirstname()
     {
          return $this->firstname;
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
          return $this->lastname;
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
      * Get the value of message
      */ 
     public function getMessage()
     {
          return $this->message;
     }

     /**
      * Set the value of message
      *
      * @return  self
      */ 
     public function setMessage($message)
     {
          $this->message = $message;

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
      * Get the value of subject
      */ 
     public function getSubject()
     {
          return $this->subject;
     }

     /**
      * Set the value of subject
      *
      * @return  self
      */ 
     public function setSubject($subject)
     {
          $this->subject = $subject;

          return $this;
     }
}