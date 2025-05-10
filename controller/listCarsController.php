<?php
session_start();
require_once("./models/ListCars.php");
require_once("./models/MyLocation.php");

class listCarsController {

    public function showListCars() { 
        $location = new MyLocation();
        $carsModel = new ListCars();
        $cars = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $cityId = $_POST['fullname'] ?? '';
            $date_reservation = $_POST['date_reservation'] ?? '';
            $date_retour = $_POST['date_retour'] ?? '';
            
            if (empty($cityId) || empty($date_reservation) || empty($date_retour)) {
                echo "error: ";

                } else {
                    $cityId = htmlspecialchars($cityId, ENT_QUOTES, 'UTF-8');
                    $date_reservation = htmlspecialchars($date_reservation, ENT_QUOTES, 'UTF-8');
                    $date_retour = htmlspecialchars($date_retour, ENT_QUOTES, 'UTF-8');

                    // Fetch city name (to display in session/view)
                    $cityData = $location->getCityById($cityId);
                    $city_name = $cityData['fullname'] ?? '';

                    // Update session with name and dates
                    $_SESSION['fullname'] = $city_name;
                    $_SESSION['date_reservation'] = $date_reservation;
                    $_SESSION['date_retour'] = $date_retour;

                // Search for cars by city ID
                $cars = $carsModel->getCarsByCityName($cityId);
            
            if (!empty($cars)) {
                $_SESSION['car_marke'] = $cars['id']['marke'];
                } else {
                    echo "There are no cars available";
                }
            }
        }

        require("./views/myListCars.php");
    }
}
?>