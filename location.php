<?php
     // Include the location controller class file
     require_once('./controller/locationController.php');
     // Create an instance of the locationController class
     $location = new locationController();
     // Call the myLocation method to handle the location functionality
     $location->myLocation();
?>