<?php
require_once('user-class.php');

class Student extends User
{
    public $type = "student";
    public function __construct() {

    }

    public function setStudent($dbc, $row) {
        parent::setUser($dbc, $row);
        $this->name = $row['student_name'];
        $this->email = $row['student_email'];
        $this->phone = $row['student_phone'];
    }

    public function isEmpty() {
        if (empty($this->name) || empty($this->email) || empty($this->phone) || empty($this->category) || empty($this->skills) || empty($this->occupation) || empty($this->location)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function printStudent() {
        echo 'Name: ' . $this->name . '
            <br>
            Email: ' . $this->email . '
            <br>
            Phone: ' . $this->phone . '
            <br>
            Field: ' . $this->category . '
            <br>
            Skills: ';
            foreach ($this->skills as $skill) {
                        echo $skill . '<br>';
                    } 
      echo  'Looking For: ';
            foreach ($this->occupation as $occ) {
                          echo $occ . '<br>';
                    }
      echo  'Location Near: ' . $this->location . '
            </p>';
    }

}
?>