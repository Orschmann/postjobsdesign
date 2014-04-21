<?php
require_once('user-class.php');

class Employer extends User
{
    function __construct($dbc, $row) {
        parent::__construct($dbc, $row);
    }

}
?>