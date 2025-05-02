<?php
    require_once("./models/Base.php");
    require_once("./models/MyReservation.php");

class reservationController {
    public function myReservation() {
        $myReservationObj = new MyReservation();
        $reservations = $myReservationObj->getMyReservation(); 

        require("./views/myReservation.php");
    }
}

$reservation = new reservationController();
$reservation->myReservation();

?>
