<?php

class Connection
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'quanlydiem2';
    private $Connection;

    function connect()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$conn) {
            die('Could not connect to database!');
        } else {
            $this->Connection = $conn;
            mysqli_set_charset($conn, 'utf8');
        }
        return $this->Connection;
    }

    function close()
    {
        mysqli_close($this->Connection);
        //echo 'Connection closed!';
    }
}

?>