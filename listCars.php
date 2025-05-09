<?php
     session_start();
     require_once('./controller/listCarsController.php');

     $listCars = new listCarsController();
     $listCars->showListCars();

?>