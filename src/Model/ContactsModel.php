<?php

namespace App\Model;

use App\Model\Model;
use App\Entity\Contacts;
use App\Database\Connection;

class ContactsModel extends Model

{
     protected $table = "contacts";
     protected $class = Contacts::class;
     protected $db;

     public function __construct() {
          $this->db = (new Connection())->getPdo();
     }
}