<?php

    include_once("./controller/reservInfoController.php");

    $controller = new ReservInfoController();
    $controller->saveReservationDetails();  // Agora com o nome mais apropriado

    $controllerUser = new ReservInfoController;
    $controllerUser->reservInfoUser($_POST['id']);
    //$reserInfo = new ReservInfoController();
    //$reserInfo->reservInfo();

?>