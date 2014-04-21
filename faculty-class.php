<?php
require_once('user-class.php');

class Faculty extends User
{
    public $department = "";
    public $type = "faculty";

    public function __construct() {

    }

    public function setFaculty($dbc, $row) {
        parent::setUser($dbc, $row);
        $this->name = $row['faculty_name'];
        $this->department = $row['faculty_department'];
        $this->email = $row['faculty_email'];
        $this->phone = $row['faculty_phone'];
    }

    public function isEmpty() {
        if (empty($this->name) || empty($this->department) || empty($this->email) || empty($this->phone) || empty($this->category) || empty($this->skills) || empty($this->location)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function printFaculty() {
        echo 'Name: ' . $this->name . '
            <br>
            Department/Discipline: ' . $this->department . '
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
      echo  'Location Near: ' . $this->location . '
            </p>';
    } 
    
}
?>