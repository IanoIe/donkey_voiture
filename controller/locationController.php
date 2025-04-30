<?php
require_once("./models/Base.php");
require_once("./models/MyRegister.php");

class locationController {
    private $MyLocation;

    public function __construct($pdo) {
        $this->MyLocation = new MyLocation($pdo);
    }

    public function showCarLocation(){
        $fullNameCity = $this->MyLocation->getCityFullName();
        $dateReservationReservation = $this->MyLocation->getDateReservationReservation();
        $dateRetourReservation = $this->MyLocation->getDateRetourReservation();
        
        require_once("./views/myLocation.php")
    }
}

include "./views/myLogin.php";
