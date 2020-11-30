<?php

namespace App\Model;

use App\Helpers\Helpers;
use App\Database\Connection;

class Model
{

     protected $table = "posts";
     protected $db;
     protected $class;

     public function __construct()
     {
          $this->db = (new Connection())->getPdo();
     }

     /**
      * Get an item from db
      * @param string $class
      * @param integer $id
      * @param boolean $instance
      * @return mixed
      */
     public function find(int $id, string $class = "")
     {
          $sql = "SELECT * FROM {$this->table} WHERE id = :id";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([':id' => $id]);
          if( $stmt->rowCount() === 1 ) {               
               return $class !== "" ? new $class($stmt->fetch()) : $stmt->fetch();
          }
          return NULL;
     }

     /**
      * Get an item from db
      * @param string $class
      * @param integer $id
      * @param boolean $instance
      * @return mixed
      */
     public function findBy(string $args = "", string $class = "")
     {
          $field = explode('.', $args)[0];
          $value = explode('.', $args)[1];
          $sql = "SELECT * FROM {$this->table} WHERE {$field} = :{$field}";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([":{$field}" => $value]);
          if( $stmt->rowCount() === 1 ) {               
               return $class !== "" ? new $class($stmt->fetch()) : $stmt->fetch();
          } else if ( $stmt->rowCount() > 1 ) {
               return $class !== "" ? $this->getInstances($stmt->fetchAll(), $class) : $stmt->fetchAll();
          } else if ( $stmt->rowCount() < 1 ) {
               return [];
          }
          return NULL;
     }

     public function findAll(string $class = "", $order_by = false)
     {
          $order = "";
          if (is_bool($order_by) && $order_by === true) {
               $order = "ORDER BY created_at DESC";
          } elseif (is_bool($order_by) && $order_by === false) {
               $order = "";
          } elseif (is_string($order_by)) {
               $explode = explode('.', $order_by);
               $order = count($explode) === 1 ? "ORDER BY {$explode[0]}" : "ORDER BY {$explode[0]} {$explode[1]}";
          }
          $sql = "SELECT * FROM {$this->table} {$order}";
          $stmt = $this->db->query($sql);
          $data = $stmt->fetchAll();
          if ( $class !== "" ) {
               return $this->getInstances($data, $class);
          }
          return $data;
     }

     public function insert(array $data, bool $last_insert = false)
     {    
          $sql = "INSERT INTO {$this->table} SET {$this->getSetTables($data)}";
          $stmt = $this->db->prepare($sql);
          if ( $stmt->execute( Helpers::transformKeys($data) )  ){
               return $last_insert === true ? $this->find((int) $this->db->lastInsertId(), $this->class) : true;
          }
          return false;
     }  

     public function update(array $set = [], array $where = [], bool $object = false) 
     {
          $sql = "UPDATE {$this->table} SET {$this->getSetTables($set)}";  
          if ( count($where) > 0 ) $sql .= " WHERE {$this->getWhereTables($where)}"; 
          $stmt = $this->db->prepare($sql); 
          $data = array_merge($set, $where);
          if ( $stmt->execute(Helpers::transformKeys($data)) ) {
               return $object === true ? $this->find((int) $where['id'], $this->class) : true;
          }
          return false;
     }

     public function delete(int $id):bool
     {
          $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
          return $stmt->execute([":id" => $id]) ? true : false;
     }

     public function getDb()
     {
          return $this->db;
     }

     public function getSetTables(array $data)
     {          
          $set = [];
          foreach ($data as $k => $v){
               $set[] = "{$k} = :{$k}";
          }
          return Helpers::putBetween(' , ', $set);
     }

     public function getWhereTables(array $data)
     {          
          $where = [];
          foreach ($data as $k => $v){
               $where[] = "{$k} = :{$k}";
          }
          return Helpers::putBetween(' AND ', $where);
     }

     public function getInstances(array $data, string $class = "") 
     {
          if ( $class === "" ) $class = $this->class; 
          $result = [];
          foreach ( $data as $key => $value ) {
               $result[$key] = new $class($value); 
          }
          return $result;
     }
     
     public function pending() 
     {
          $sql = "SELECT * FROM {$this->table} WHERE status = 'pending' ORDER BY created_at DESC";
          $data = $this->db->query($sql)->fetchAll();
          return $this->getInstances($data);
     }

}