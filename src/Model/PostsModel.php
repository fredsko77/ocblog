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
     protected $pdo;

     public function __construct() 
     {
          $this->pdo = (new Connection())->getPdo();
     }

     /**
      * pagePosts
      * @param integer $page
      * @return array
      */
     public function pagePosts(int $page = 0):array
     {
          $offset = ($page * $this->limit);       
          $sql = "  SELECT * 
                    FROM {$this->table}
                    WHERE status = 'published' 
                    ORDER BY updated_at DESC
                    LIMIT {$this->limit} OFFSET {$offset};";
          $stmt = $this->pdo->prepare($sql);
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
          return $this->getInstances($this->pdo->query($sql)->fetchAll(), $this->class);
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
          return $this->getInstances($this->pdo->query($sql)->fetchAll(), $this->class);
     }
     
     /**
      * published posts
      * @return array
      */
     public function category(int $int):array
     {
          $sql = "  SELECT * FROM {$this->table}
                    WHERE status = 'published'
                    AND category_id = :category_id 
                    ORDER BY updated_at DESC;";
          $stmt = $this->pdo->prepare($sql);
          if ( $stmt->execute([':category_id' => $int]) ) {
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
          $stmt = $this->pdo->prepare($sql);
          if ( $stmt->execute([':category_id' => $category]) ){
               return $this->getInstances($stmt->fetchAll(), $this->class);
          }
          return [];
     }

     /**
      * nbPost
      * @return object
      */
     public function nbPost():object
     {
          return $this->pdo->query("SELECT COUNT(id) AS nb_posts FROM {$this->table} WHERE status = 'published'")->fetch(\PDO::FETCH_OBJ);
     }

     /**
      * Auth posts
      * @param integer $int
      * @return array
      */
     public function authPosts(int $int):array
     {
          $sql = "  SELECT * FROM {$this->table}
                    WHERE writer = :writer 
                    ORDER BY updated_at DESC;";
          $stmt = $this->pdo->prepare($sql);
          if ( $stmt->execute([':writer' => $int]) ) {
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
          return $this->getInstances($this->pdo->query($sql)->fetchAll(), $this->class); 
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
          return new Posts($this->pdo->query($sql)->fetch());
     }

}