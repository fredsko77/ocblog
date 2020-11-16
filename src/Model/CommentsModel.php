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

     public function getPostComments(int $posts_id)
     {
          $sql = "SELECT * FROM comments WHERE posts_id = :id AND status = :status";
          $this->db->prepare($sql);
     }


}