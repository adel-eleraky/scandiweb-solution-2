<?php 

namespace App\Http\Request;

use App\Database\Config\Connection;

class Validation extends Connection {

    private $input , $inputName;
    private $errors = [];

    // function to check if the input is empty 
    public function required(): self {

        if(empty($this->input)){
            $this->errors[$this->inputName][__FUNCTION__] = "$this->inputName is required";
        }
        return $this;
    }

    // function to check if the input is number 
    public function numeric(): self {

        if(! is_numeric($this->input)){
            $this->errors[$this->inputName][__FUNCTION__] = "$this->inputName must be number";
        }
        return $this;
    }

    // function to check if the input is unique 
    public function unique(string $tableName , string $columnName): self {

        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ? ";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("s" , $this->input);
        $statement->execute();
        $result = $statement->get_result();
        if($result->num_rows == 1){
            $this->errors[$this->inputName][__FUNCTION__] = "$this->inputName must be unique";
        }
        return $this;
    }

    // function to get first error message of the input to display
    public function getErrorMessage(string $inputName){

        if(isset($this->errors[$inputName])){
            foreach($this->errors[$inputName] as $err){
                return "<span class='error' style='color: red;'>{$err}</span>";
            }
        }
    }
    /**
     * Get the value of input
     */ 
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set the value of input
     *
     * @return  self
     */ 
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get the value of inputName
     */ 
    public function getInputName()
    {
        return $this->inputName;
    }

    /**
     * Set the value of inputName
     *
     * @return  self
     */ 
    public function setInputName($inputName)
    {
        $this->inputName = $inputName;

        return $this;
    }

    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */ 
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }
}



?>