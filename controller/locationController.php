<?php
require_once("./models/Base.php");
require_once("./models/MyLocation.php");

class locationController {
    public function myLocation(){
        $locationsObj = new MyLocation();
        $locations = $locationsObj->getMyLocation();

        require("./views/myLocation.php");
    }
}

$location = new locationController();
$location->myLocation();


?>
