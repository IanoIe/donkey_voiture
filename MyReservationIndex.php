<?php
     require_once('./controller/MyReservationController.php');

     $myReservations = new MyReservationController();
     $myReservations->getMyReservation();
?>