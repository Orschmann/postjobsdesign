<?php
class User
{
    public $name = "";
    public $email = "";
    public $phone = "";
    public $category = "";
    public $skills = array();
    public $occupation = array();
    public $location = "";
    public $type = "";

    public function setUser($dbc, $row) {
        $this->setCategory($dbc, $row);
        $this->setSkills($dbc, $row);
        $this->setLocation($dbc, $row);
        $this->setOccupation($dbc, $row);
    }

    public function setSkills($dbc, $row) {
        $row_field = $this->type . '_skill_';
        for ($i = 0; $i < 5; $i++){
            $skill_id = $row[$row_field . ($i+1)];
            if ($skill_id != null) {
                $skill_query = mysqli_query($dbc, "SELECT skill_name FROM skills WHERE skill_id = '$skill_id'");
                $this->skills[] = (mysqli_fetch_object($skill_query)->skill_name);  
            }     
        }
    }

    public function setOccupation($dbc, $row) {
        $row_field = $this->type . '_occupation_';
        for ($i = 0; $i < 4; $i++){            
            $occupation_id = $row[$row_field . ($i+1)];
            if ($occupation_id != null) {
                $occupation_query = mysqli_query($dbc, "SELECT occ_name FROM occupation WHERE occ_id = '$occupation_id'");
                $this->occupation[] = (mysqli_fetch_object($occupation_query)->occ_name);       
            }
        }    
    }

    public function setLocation($dbc, $row) {
        $row_field = $this->type . '_location';
        $loc_query = mysqli_query($dbc, "SELECT location_name FROM location WHERE location_id = '$row[$row_field]'");
        $this->location = (mysqli_fetch_object($loc_query)->location_name);
    }

    public function setCategory($dbc, $row) {
        $row_field = $this->type . '_category';
        $cat_query = mysqli_query($dbc, "SELECT cat_name FROM categories WHERE cat_id = '$row[$row_field]'");
        $this->category = (mysqli_fetch_object($cat_query)->cat_name);
    }

    public function isEmpty() {
        if (empty($this->name) || empty($this->email) || empty($this->phone) || empty($this->category) || empty($this->skills) || empty($this->occupation) || empty($this->location)) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>