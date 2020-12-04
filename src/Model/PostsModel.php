<?php

namespace App\Model;

use App\Model\Model;
use App\Entity\Posts;
use App\Database\Connection;

class PostsModel extends Model

{
     protected $table = "posts";
     protected $class = Posts::class;
     private $limit = 10;
     protected $db;

     public function __construct() 
     {
          $this->db = (new Connection())->getPdo();
     }

     /**
      * pagePosts
      * @param integer $page
      * @return array
      */
     public function pagePosts(int $page = 0):array
     {
          $offset = ($page * $this->limit);          
          $data = [];
          $sql = "  SELECT * 
                    FROM {$this->table}
                    WHERE status = 'published' 
                    ORDER BY updated_at DESC
                    LIMIT {$this->limit} OFFSET {$offset};";
          $stmt = $this->db->prepare($sql);
          $stmt->execute();
          return $this->getInstances($stmt->fetchAll(), $this->class);
     }
     
     /**
      * published posts
      * @return array
      */
     public function published():array
     {
          $sql = "  SELECT * FROM {$this->table}
                    WHERE status = 'published' 
                    ORDER BY updated_at DESC;";
          return $this->getInstances($this->db->query($sql)->fetchAll(), $this->class);
     }
     
     /**
      * draft posts
      * @return array
      */
     public function draft():array
     {
          $sql = "  SELECT * FROM {$this->table}
                    WHERE status = 'draft' 
                    ORDER BY updated_at DESC;";
          return $this->getInstances($this->db->query($sql)->fetchAll(), $this->class);
     }
     
     /**
      * published posts
      * @return array
      */
     public function category(int $id):array
     {
          $sql = "  SELECT * FROM {$this->table}
                    WHERE status = 'published'
                    AND category_id = :category_id 
                    ORDER BY updated_at DESC;";
          $stmt = $this->db->prepare($sql);
          if ( $stmt->execute([':category_id' => $id]) ) {
               return $this->getInstances($stmt->fetchAll(), $this->class);
          }
          return [];
     }
     
     /**
      * similar posts
      * @param integer $category
      * @return array
      */
     public function similar (int $category):array 
     {
          $sql = "  SELECT *
                    FROM {$this->table}
                    WHERE category_id = :category_id
                    AND status = 'published'
                    ORDER BY updated_at DESC
                    LIMIT 5 OFFSET 0";
          $stmt = $this->db->prepare($sql);
          if ( $stmt->execute([':category_id' => $category]) ){
               return $this->getInstances($stmt->fetchAll(), $this->class);
          }
          return [];
     }

     public function nbPost()
     {
          return $this->db->query("SELECT COUNT(id) AS nb_posts FROM {$this->table} WHERE status = 'published'")->fetch(\PDO::FETCH_OBJ);
     }

     /**
      * Auth posts
      * @param integer $id
      * @return array
      */
     public function authPosts(int $id):array
     {
          $sql = "  SELECT * FROM {$this->table}
                    WHERE writer = :writer 
                    ORDER BY updated_at DESC;";
          $stmt = $this->db->prepare($sql);
          if ( $stmt->execute([':writer' => $id]) ) {
               return $this->getInstances($stmt->fetchAll(), $this->class);
          }
          return [];
     }
     
     /**
      * latest
      * @return array
      */
     public function latest():array 
     {
          $sql = "  SELECT * 
                    FROM {$this->table}
                    WHERE status = 'published'
                    ORDER BY updated_at DESC
                    LIMIT 5
                    OFFSET 0";
          return $this->getInstances($this->db->query($sql)->fetchAll(), $this->class); 
     }

     /**
      * lastUpdatedPost
      * @return Posts
      */
     public function lastUpdatedPost():Posts
     {
          $sql = "  SELECT *
                    FROM {$this->table}
                    WHERE status = 'draft'
                    ORDER BY updated_at DESC
                    LIMIT 1
                    OFFSET 0";
          return new Posts($this->db->query($sql)->fetch());
     }

}