<?php

require_once __DIR__ . '/Student.php';

class Undergrad extends Student {
    protected $course;
    protected $year;

    public function __construct($name, $number, $course, $year) {
        $this->course = $course;
        $this->year = $year;
        parent::__construct($name, $number);
    }
}

?>