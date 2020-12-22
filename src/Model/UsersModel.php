<?php

namespace App\Model;

use \PDO;
use App\Model\Model;
use App\Entity\Users;
use App\Services\Session;
use App\Database\Connection;

class UsersModel extends Model
{
     protected $table = "users";
     protected $class = Users::class;
     protected $pdo;

     public function __construct() 
     {
          $this->pdo = (new Connection())->getPdo();
     }

     public function checkUserExists(string $email):bool
     {
          $sql = "SELECT email FROM {$this->table} WHERE email = :email";
          $stmt = $this->pdo->prepare($sql);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->rowCount() > 0 ? true : false; 
     }

     public function findUserByEmail(string $email)
     {
          $sql = "SELECT * FROM {$this->table} WHERE email = :email";
          $stmt = $this->pdo->prepare($sql);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->rowCount() > 0 ? new Users($stmt->fetch()) : null; 
     }

     public function findUserByToken(string $token)
     {
          $sql = "SELECT * FROM {$this->table} WHERE token = :token";
          $stmt = $this->pdo->prepare($sql);
          $stmt->bindParam(':token', $token, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->rowCount() === 1 ? new Users($stmt->fetch()) : null; 
     }
     
     public function confirmUser(Users $user)
     {
          $sql = "UPDATE {$this->table} SET confirm = :confirm, token = :token WHERE id = :id";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute([ 
               ':confirm' => 1, 
               ':token' => generate_token(80),
               ':id' => $user->getId()
          ]);
     }
     
     public function updateLogin(Users $users) 
     {
          $sql = "UPDATE {$this->table} SET token = :token, last_connection = :last_connection WHERE id = :id";
          $stmt = $this->pdo->prepare($sql);
          $data = [
               ':id' => $users->getId(), 
               ':token' => $users->getToken(), 
               ':last_connection' => $users->getLastConnection()
          ];
          return $stmt->execute($data) ? true : false;
     }

     public function exceptAuth() 
     {
          $auth = (new Session)->getLoggedUser();
          $sql  = "SELECT * FROM {$this->table} WHERE id <> {$auth->getId()}";
          return $this->getInstances($this->pdo->query($sql)->fetchAll(), $this->class);
     }

}