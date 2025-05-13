<?php
    include_once("./controller/reservInfoController.php");

    $controller = new ReservInfoController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->saveReservationDetails();
    // Verifica e busca o user se o ID estiver no POST
    if (isset($_POST['id'])) {
        $controller->reservInfoUser((int) $_POST['id']);
    }
}

?>