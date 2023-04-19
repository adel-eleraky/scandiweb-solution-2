<?php 

namespace App\Database\Models;


class Product extends Model {
    

    private $id , $sku , $name , $price , $category , $details;
    
    // get all books data
    public function getData(){
        $query = "SELECT * FROM products";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $result =  $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    
    public function insert(){
        $query = "INSERT INTO products ( sku , name , price , category , details ) VALUES ( ? , ? , ? , ? , ? )";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("ssiss" , $this->sku , $this->name , $this->price , $this->category , $this->details);
        return $statement->execute();
    }

    public function delete(){
        $query = "DELETE FROM products WHERE id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("i" , $this->id);
        return $statement->execute();
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of details
     */ 
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set the value of details
     *
     * @return  self
     */ 
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    
}





?>