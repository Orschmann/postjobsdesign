<?php
require_once('user-class.php');

class Employer extends User
{
    public $contact_name = "";
    public $type = "employer";

    public function __construct() {

    }

    public function setEmployer($dbc, $row) {
        parent::setUser($dbc, $row);
        $this->name = $row['employer_name'];
        $this->contact_name = $row['employer_contact_name'];
        $this->email = $row['employer_email'];
        $this->phone = $row['employer_phone'];
    }

    public function isEmpty() {
        if (empty($this->name) || empty($this->contact_name) || empty($this->email) || empty($this->phone) || empty($this->category) || empty($this->skills) || empty($this->occupation) || empty($this->location)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function printEmployer() {
        echo 'Company Name: ' . $this->name . '
            <br>
            Contact Name: ' . $this->contact_name . '
            <br>
            Contact Email: ' . $this->email . '
            <br>
            Contact Phone: ' . $this->phone . '            
            <br>
            Field: ' . $this->category . '
            <br>
            Skills Needed: ';
            foreach ($this->skills as $skill) {
                        echo $skill . '<br>';
                    } 
      echo  'Offering: ';
            foreach ($this->occupation as $occ) {
                          echo $occ . '<br>';
                }
      echo  'Location Near: ' . $this->location . '
            </p>';
    } 
    
}
?>