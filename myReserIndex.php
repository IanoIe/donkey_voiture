<?php
     require_once('./controller/myReservationController.php');

     $myReservations = new myReservationController();
     $myReservations->getMyReservation();
?>