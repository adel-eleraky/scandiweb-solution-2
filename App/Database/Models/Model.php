<?php 

namespace App\Database\Models;

use App\Database\Config\Connection;


abstract class Model extends Connection {


    abstract public function getData();

    abstract public function insert();

    abstract public function delete();

}



?>