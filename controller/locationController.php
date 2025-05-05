<?php
     require_once("./models/Base.php");
     require_once("./models/MyLocation.php");

class LocationController {
    public function myLocation() {

        $citiesObj = new MyLocation();
        $cities = $citiesObj->getMyLocationCity(); 

        require("./views/myLocation.php");
    }
}

$controller = new locationController();
$controller->myLocation();

?>
