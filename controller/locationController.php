<?php
     require_once("./models/Base.php");
     require_once("./models/MyLocation.php");

class locationController {
    public function myLocation() {
        
        $location = new MyLocation(); 
        $cities = $location->getMyLocationCity(); 
        
        require("./views/myLocation.php");
    }
}


$controller = new locationController();
$controller->myLocation();
?>
