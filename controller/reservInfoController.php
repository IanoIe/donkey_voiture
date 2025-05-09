<?php     
require_once ("./models/ReservInfo.php");

class ReservInfoController{
    public function reservInfo() {
        $carId = isset($_GET['car_id']) && is_numeric($_GET['car_id']) ? (int) $_GET['car_id'] : 1;
        $reservInfo = new ReservInfo();
        
        $info = $reservInfo->getReservInfoUnik($carId);
        require("./views/reservInfo.php");
    }
}

$reservInfoController = new ReservInfoController();
$reservInfoController->reservInfo();
?>
