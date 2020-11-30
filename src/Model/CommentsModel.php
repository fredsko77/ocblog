<?php

namespace App\Model;

use App\Model\Model;
use App\Entity\Comments;
use App\Database\Connection;

class CommentsModel extends Model

{
     protected $table = "comments";
     protected $class = Comments::class;
     protected $db;

     public function __construct() {
          $this->db = (new Connection())->getPdo();
     }

     public function getPostComments(int $post_id)
     {
          $sql = "SELECT * FROM {$this->table} WHERE post_id = :post_id AND status = 'validated' ORDER BY created_at DESC";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([':post_id' => $post_id]);
          $result = $stmt->fetchAll();
          return $this->getInstances($result, $this->class);
     }

}