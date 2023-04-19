<?php 

namespace App\Database\Config;

class Connection {
    private $hostName = "localhost";
    private $databaseName = "scandiweb";
    private $databaseUserName = "root";
    private $databasePassword = "";
    private $port = 3306;
    protected \mysqli $conn;

    // open connection to database
    public function __construct()
    {
        $this->conn = new \mysqli($this->hostName , $this->databaseUserName , $this->databasePassword , $this->databaseName , $this->port);

        // check connection error
        // if($this->conn->connect_error){
        //     die("connection failed" . $this->conn->connect_error);
        // }
        // echo "connected successfully";
    }

    // close connection 
    public function __destruct()
    {
        $this->conn->close();
    }


}




?>