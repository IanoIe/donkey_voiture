<?php
     // Includes the listCarsController.php file
     require_once('./controller/listCarsController.php');
     // Creates an instance of the listCarsController class
     $listCars = new listCarsController();
     // Calls the showListCars method of the listCarsController class
     $listCars->showListCars();
?>