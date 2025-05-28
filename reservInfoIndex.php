<?php
session_start();
include_once("./controller/reservInfoController.php");

$controller = new ReservInfoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'saveReservationToDatabase') {
        $controller->saveReservationToDatabase();
    } else {
        $controller->saveReservationDetails();
    }
}
?>


