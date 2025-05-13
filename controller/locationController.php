<?php
session_start();
require_once("./models/MyLocation.php");
    
class locationController {
    public function myLocation() {
        $location = new MyLocation(); 
        $cities = $location->getMyLocationCity(); 
        
        require("./views/myLocation.php");
    }
}
?>
