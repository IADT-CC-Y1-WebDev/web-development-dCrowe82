<?php

namespace College;

class Student {
    protected $name;
    protected $number;

    private static $students = [];

    public function __construct($name, $number) {

        echo "creating student: " . $name . "<br>";

        $this->name = $name;

        if ($number == "") {
            throw new Exception("student number required");
        } 

        $this->number = $number;
        self::$students[$number] = $this;
        
    }

    public function __toString() {
        return "Student: " . $this->name . " (" . $this->number . ")";
    }

    public function __destruct() {
        echo "destructing student: " . $this->name . "<br>";
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


    public static function findAll() {
        return self::$students;
    }

    public static function getCount() {
        return count(self::$students);
    }
    
    public static function findByNumber($num) {
        return self::$students[$num] ?? null;
    }

    public function leave() {
        unset(self::$students[$this->number]);
    }   

}

?>