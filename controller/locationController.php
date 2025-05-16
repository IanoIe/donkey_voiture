<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}
require_once("./models/MyLocation.php");
    
class locationController {
    /**
    * Displays the user's location information.
    * This method retrieves the user's location data and passes it to the view for display.
    * It ensures that the user is authenticated before accessing this information.
    * @return void  */
    public function myLocation() {
        $location = new MyLocation(); 
        $cities = $location->getMyLocationCity(); 
        
        require("./views/myLocation.php");
    }
}
?>
