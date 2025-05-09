<?php
require_once("./models/ReservInfo.php");

class ReservInfoController {
    public function reservInfo() {
        $carId = isset($_GET['car_id']) && is_numeric($_GET['car_id']) ? (int) $_GET['car_id'] : 1;
        $reservInfo = new ReservInfo();
        
        session_start();
        $city_name = $_SESSION['fullname'] ?? 'N/A';
        $date_reservation = $_SESSION['date_reservation'] ?? 'N/A';
        $date_retour = $_SESSION['date_retour'] ?? 'N/A';

        // Passando os dados para o método do modelo
        $info = $reservInfo->getReservInfoUnik($carId, $city_name, $date_reservation, $date_retour);
        require("./views/reservInfo.php");
    }
}

$reservInfoController = new ReservInfoController();
$reservInfoController->reservInfo();
?>
