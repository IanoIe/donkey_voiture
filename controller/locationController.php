<?php

require_once("./models/Base.php");
require_once("./models/MyLocation.php");

class locationController {
    public function myLocation() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $city = $_POST['city'] ?? '';
            $date_reservation = $_POST['date_reservation'] ?? '';
            $date_retour = $_POST['date_retour'] ?? '';

            $locationObj = new MyLocation($city, $date_reservation, $date_retour);

            if ($locationObj->validateFields()) {
                $locations = $locationObj->getMyLocation();

                require("./views/myLocation.php");
            } else {
                
            }
        }
    }
}

$controller = new LocationController();
$controller->myLocation();

?>
