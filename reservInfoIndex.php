<?php
    include_once("./controller/reservInfoController.php");

    $controller = new ReservInfoController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->saveReservationDetails();
    // Check and fetch the user if the ID is in the POST
    if (isset($_POST['id'])) {
        $controller->reservInfoUser((int) $_POST['id']);
    }
}

?>