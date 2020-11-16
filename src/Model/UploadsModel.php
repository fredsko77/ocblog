<?php

namespace App\Model;

use App\Model\Model;
use App\Entity\Uploads;
use App\Helpers\Helpers;
use App\Database\Connection;

class UploadsModel extends Model

{
     protected $table = "uploads";
     protected $class = Uploads::class;
     protected $db;

     public function __construct() {
          $this->db = (new Connection())->getPdo();
     }

     public function update_image(array $args = [], bool $return = false)
     {
          $field = array_key_exists('posts_id', $args) ? 'posts_id' :'users_id';
          $value = $args[$field];
          unset($args[$field]);
          $sql = "UPDATE {$this->table} SET {$this->getSetTables($args)} WHERE {$field} = :{$field}"; 
          $stmt = $this->db->prepare($sql); 
          $data = array_merge($args, [$field => $value]);
          if ( $stmt->execute(Helpers::transformKeys($data)) ) return $return ? $this->findBy("{$field}.{$value}", $this->class) : true;
          return false;
     }

     public function findPath(int $id)
     {
          return $this->db->query("SELECT path FROM {$this->table} WHERE id = {$id}", \PDO::FETCH_OBJ)->fetch();
     }
     
}