<?php
session_start();

if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}
require_once("./models/MyReservation.php");

/** Class MyReservationController
 * This controller handles the user's reservation-related actions.
 * It ensures that the user is authenticated before accessing reservation data. */
class MyReservationController {
    private $model;
    private $userId;

    /** MyReservationController constructor.
     * Initializes the controller by checking if the user is logged in.
     * If not, redirects to the login page.*/
    public function __construct() {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: /MyLogin.php');
            exit;
        }
        $this->userId = $_SESSION['user']['id'];
        $this->model = new MyReservation();
    }
    /** Retrieves and displays the user's reservations.
     * Fetches all reservations associated with the logged-in user.
     * If an error occurs during the process, it displays the error message. */
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
