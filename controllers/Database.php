<?php

namespace Controller;

use PDO;

class Database
{
    public function connect()
    {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=reminder_db', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        return $conn;
    }
}
