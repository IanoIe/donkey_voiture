<?php
     require_once("./models/Base.php");
     require_once("./models/ListCars.php");
     require_once("./models/MyLocation.php");

class ListCarsController {
    public function showListCars() { 
        $location = new MyLocation();
        $carsModel = new ListCars();
        $cities = $location->getMyLocationCity();
        
        $cars = [];
        $noCars = false;
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            echo "POST ";
            $city_name = $_POST['fullname'] ?? '';
            $date_reservation = $_POST['date_reservation'] ?? '';
            $date_retour = $_POST['date_retour'] ?? '';

            // Validação dos campos
            if (empty($city_name) || empty($date_reservation) || empty($date_retour)) {
                echo "error";
                $error = 'Todos os campos são obrigatórios.';
            } else {
                echo " On cherche un car!";
                // Sanitização dos dados
                $city_name = htmlspecialchars($city_name);
                $date_reservation = htmlspecialchars($date_reservation);
                $date_retour = htmlspecialchars($date_retour);

                // Busca os carros disponíveis
                $cars = $carsModel->getCarsByCityName($city_name);
                if (empty($cars)) {
                    $noCars = true;
                    echo " Il y a pas de cars";
                }
            }
        }

        require("./views/myListCars.php");
    }
}

$listCars = new ListCarsController();
$listCars->showListCars();
?>
