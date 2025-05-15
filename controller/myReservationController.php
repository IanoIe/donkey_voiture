<?php
session_start();

if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}

require_once("./models/MyReservation.php");
class MyReservationController {
    private $model;
    private $userId;

    public function __construct() {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: /MyLogin.php');
            exit;
        }
        $this->userId = $_SESSION['user']['id'];
        $this->model = new MyReservation();
    }

    public function getMyReservation() {
        try {
            $myReservations = $this->model->getReservationsByUser($this->userId);
            require_once("./views/myReservation.php");
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
}
?>
