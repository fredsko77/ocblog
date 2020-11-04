<?php

namespace App\Model;

use App\Model\Model;
use App\Entity\Posts;

class PostsModel extends Model

{
     protected $table = "posts";
     protected $class = Posts::class;
     private $limit = 10;

     public function __construct()
     {         
     }

     public function pagePosts(int $page = 0)
     {
          $offset = $page;
          $this->limit;
          $data = [];
          $sql = "SELECT * FROM posts WHERE status = 'published' LIMIT :limit OFFSET :offset";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([':limit' => $this->limit, ':offset' => $offset]);
          $results = $stmt->fetchAll();
          foreach($results as $k => $result) {
               $data[] = new Posts($result);
          }
     }

}