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

     public function __construct() {
          $this->db = (new Connection())->getPdo();
     }

     public function pagePosts(int $page = 0)
     {
          $offset = ($page * $this->limit);          
          $data = [];
          $sql = "  SELECT * 
                    FROM posts 
                    WHERE status = 'published' 
                    ORDER BY updated_at DESC
                    LIMIT {$this->limit} OFFSET {$offset}";
          $stmt = $this->db->prepare($sql);
          $stmt->execute();
          $results = $stmt->fetchAll();
          foreach($results as $k => $result) {
               $data[] = new Posts($result);
          }
          return $data;
     }

}