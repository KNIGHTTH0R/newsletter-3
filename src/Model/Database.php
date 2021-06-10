<?php

namespace Pineapple\Model;

use mysqli;

class Database
{

    public function __construct()
    {   
        require('config/db.php');
        $this->table = $table;
        $this->connect = new mysqli($host, $usr, $pwd, $db);
        return $this->connect;
    }
    
    public function index($orderBy)
    {
        $result = $this->connect->query("SELECT * from $this->table ORDER BY $orderBy");
        return $result;
    }

    public function insert($email)
    {
        $email_clean = $this->connect->real_escape_string($email);        // Escape special chars
        $this->connect->query("INSERT INTO $this->table (email) VALUES ('$email_clean')");
    }

    public function remove($id)
    {
        $id_clean = $this->connect->real_escape_string($id);
        $this->connect->query("DELETE FROM $this->table WHERE id='$id_clean'");
    }

    public function find($email)
    {
        $result = $this->connect->query("SELECT * from $this->table WHERE email='$email'");
        if ($result->num_rows > 0) {
            return true;
        }
    }

}