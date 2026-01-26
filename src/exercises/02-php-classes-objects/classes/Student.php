<?php

class Student {
    protected $name;
    protected $number;

    public function __construct($name, $number) {

        echo "creating student: " . $name . "<br>";

        $this->name = $name;

        if ($number == "") {
            throw new Exception("student number required");
        } 

        $this->number = $number;
        
    }

    public function __toString() {
        return "Student: " . $this->name . " (" . $this->number . ")";
    }

    public function __destruct() {
        echo "destructing student: " . $this->name;
    }

    public function displayDetails() {
        echo "name: " . $this->name . ", number: " . $this->number . "<br>"; 
    }

    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }

}

?>