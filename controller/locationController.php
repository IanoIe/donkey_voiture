<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);

     require_once("./models/Base.php");
     require_once("./models/MyLocation.php");

class locationController {
    public function myLocation() {
        
        $location = new MyLocation(); // cria a instância
        $cities = $location->getMyLocationCity(); 
        
        require("./views/myLocation.php");
    }
}


$controller = new locationController();
$controller->myLocation(); // Ou chamar $controller->getMyLocationCars() dependendo da rota
?>
