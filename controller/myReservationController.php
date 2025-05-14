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
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Mylogin');
            exit;
        }
        $this->userId = $_SESSION['user_id'];
        $this->model = new MyReservation();
    }

    public function getMyReservation() {
        try {
            echo "Controller chamou o método<br>";
            $myReservations = $this->model->getReservationsByUser($this->userId);
            require_once("../views/myReservation.php");
        } catch (Exception $ex) {
            // Redirecionar para uma página de erro ou registrar o erro
            echo "Error: ".$ex->getMessage();
        }
    }
}
?>
