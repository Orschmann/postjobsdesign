<?php
require_once('user-class.php');

class Student extends User
{
    public function __construct() {

    }

    public function setStudent($dbc, $row) {
        parent::setUser($dbc, $row);
        $this->name = $row['student_name'];
        $this->email = $row['student_email'];
        $this->phone = $row['student_phone'];
    }


}
?>