<?php
     // Includes the MyReservationController.php file
     require_once('./controller/MyReservationController.php');
     // Instantiate the MyReservationController class
     $myReservations = new MyReservationController();
     // Call the getMyReservation method to retrieve the user's reservation details
     $myReservations->getMyReservation();
?>