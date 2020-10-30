<?php

namespace App\Database;

use PDO,
    PDOEXCEPTION;

class Connection
{
    public function __construct()
    {
        $this->database = require "../config/database.php";    
    }

    /**
     * Return an instance of connection to database
     * @return \PDO
     */
    public function getPdo()
    {          
        try
        {
            $pdo    = new PDO("mysql:host={$this->database->dbhost};dbname={$this->database->dbname};charset=utf8", $this->database->dbuser , $this->database->dbpass );
            $pdo    ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $pdo    ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOEXCEPTION $e)
        {
            dd("An error occured while trying to connect to database: " . $e->getMessage());
        }
        return $pdo;
    } 

}