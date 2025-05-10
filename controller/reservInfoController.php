<?php
require_once("./models/ReservInfo.php");

class ReservInfoController {
    public function reservInfo() {
        $carId = isset($_GET['car_id']) && is_numeric($_GET['car_id']) ? (int) $_GET['car_id'] : 1;
        $reservInfo = new ReservInfo();
        
        session_start();
        $city_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'N/A';
        $carsMarke = isset($_SESSION['car_marke']) ? $_SESSION['car_marke'] : 'N/A';
        $date_reservation = isset($_SESSION['date_reservation']) ? $_SESSION['date_reservation'] : 'N/A';
        $date_retour = isset($_SESSION['date_retour']) ? $_SESSION['date_retour'] : 'N/A';

        // Passando os dados para o método do modelo
        $info = $reservInfo->getReservInfoUnik($carId, $city_name, $carsMarke, $date_reservation, $date_retour);
        require("./views/reservInfo.php");
    }
}

$reservInfoController = new ReservInfoController();
$reservInfoController->reservInfo();
?>
