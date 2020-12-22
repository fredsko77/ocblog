<?php

namespace App\Model;

use App\Model\Model;
use App\Entity\Categories;
use App\Database\Connection;

class CategoriesModel extends Model

{
     protected $table = "categories";
     protected $class = Categories::class;
     protected $pdo;

     public function __construct() {
          $this->pdo = (new Connection())->getPdo();
     }

}