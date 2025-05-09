<?php
require_once("./models/ListCars.php");
require_once("./models/MyLocation.php");

class listCarsController {

    public function showListCars() { 
        $location = new MyLocation();
        $carsModel = new ListCars();
            
        $cars = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $city_name = $_POST['fullname'] ?? '';
            $date_reservation = $_POST['date_reservation'] ?? '';
            $date_retour = $_POST['date_retour'] ?? '';

            if (empty($city_name) || empty($date_reservation) || empty($date_retour)) {
                echo "error";
            } else {
                // Assainissement des données
                $city_name = htmlspecialchars($city_name);
                $date_reservation = htmlspecialchars($date_reservation);
                $date_retour = htmlspecialchars($date_retour);

                session_start();
                $_SESSION['fullname'] = $city_name;
                $_SESSION['date_reservation'] = $date_reservation;
                $_SESSION['date_retour'] = $date_retour;

                // The cars in
                $cars = $carsModel->getCarsByCityName($city_name);
                
                $_SESSION['fullname'] = $cars[0]['fullname'];
                if (empty($cars)) {
                    echo " Il y a pas de cars";
                }
            }
        }
        require("./views/myListCars.php");
    }
}

$listCars = new listCarsController();
$listCars->showListCars();
?>
