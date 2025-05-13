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
            $cityId = isset($_POST['fullname']) ? (int) $_POST['fullname'] : null;
            $date_reservation = $_POST['date_reservation'] ?? '';
            $date_retour = $_POST['date_retour'] ?? '';

            if (empty($cityId) || empty($date_reservation) || empty($date_retour)) {
                echo "Por favor preencha todos os campos.";
            } else {
                // Sanitização
                $cityId = htmlspecialchars($cityId, ENT_QUOTES, 'UTF-8');
                $date_reservation = htmlspecialchars($date_reservation, ENT_QUOTES, 'UTF-8');
                $date_retour = htmlspecialchars($date_retour, ENT_QUOTES, 'UTF-8');

                // Guardar em sessão
                $_SESSION['fullname'] = $location->getCityById($cityId)['fullname'] ?? '';
                $_SESSION['date_reservation'] = $date_reservation;
                $_SESSION['date_retour'] = $date_retour;

                // Buscar carros disponíveis até a data de reserva
                $cars = $carsModel->getCarsByCityName($cityId, $date_reservation);

                if (empty($cars)) {
                    $message = "Não há carros disponíveis nesta cidade após essa data.";
                }
            }
        }

        // Envia os dados para a view
        require("./views/myListCars.php");
    }
}
?>
