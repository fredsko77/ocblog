<?php

namespace App\Model;

use App\Database\Connection;
use App\Model\Model;
use App\Entity\Users;
use \PDO;

class UsersModel extends Model
{
     protected $table = "users";
     protected $class = Users::class;
     protected $db;

     public function __construct() {
          $this->db = (new Connection())->getPdo();
     }

     public function checkUserExists(string $email):bool
     {
          $sql = "SELECT email FROM {$this->table} WHERE email = :email";
          $stmt = $this->db->prepare($sql);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->rowCount() > 0 ? true : false; 
     }

     public function findUserByEmail(string $email)
     {
          $sql = "SELECT * FROM {$this->table} WHERE email = :email";
          $stmt = $this->db->prepare($sql);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->rowCount() > 0 ? new Users($stmt->fetch()) : null; 
     }

     public function findUserByToken(string $token)
     {
          $sql = "SELECT * FROM {$this->table} WHERE token = :token";
          $stmt = $this->db->prepare($sql);
          $stmt->bindParam(':token', $token, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->rowCount() === 1 ? new Users($stmt->fetch()) : null; 
     }
     
     public function confirmUser(Users $user)
     {
          $sql = "UPDATE {$this->table} SET confirm = 1 WHERE token = :token";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([':token' => $user->getToken()]);
     }
     
     public function updateLogin(Users $users) 
     {
          $sql = "UPDATE {$this->table} SET token = :token, last_connection = :last_connection WHERE id = :id";
          $stmt = $this->db->prepare($sql);
          $stmt->execute([
               ':id' => $users->getId(), 
               ':token' => $users->getToken(), 
               ':last_connection' => $users->getLastConnection()
          ]);
     }

}