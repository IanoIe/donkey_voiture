<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}
require_once("./models/MyLocation.php");
    
class locationController {
    public function myLocation() {
        $location = new MyLocation(); 
        $cities = $location->getMyLocationCity(); 
        
        require("./views/myLocation.php");
    }
}
?>
