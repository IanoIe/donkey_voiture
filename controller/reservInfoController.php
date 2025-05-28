<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}
require_once("./models/ReservInfo.php");


/** Class ReservInfoController
 * Handles reservation information processes, including saving reservation details,
 * displaying reservation information, and managing reservation requests. */
class ReservInfoController {
    /** Saves reservation details from POST request into session variables.
     * Validates the incoming POST data for reservation details and stores them
     * in session variables for later use. Redirects to the reservation information
     * view upon successful validation or to an error page if validation fails.
     * @return void */
    public function saveReservationDetails() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
            $marke = htmlspecialchars($_POST['marke'] ?? '');
            $price = htmlspecialchars($_POST['price'] ?? '');
            $date_reservation = htmlspecialchars($_POST['date_reservation'] ?? '');
            $date_retour = htmlspecialchars($_POST['date_retour'] ?? '');

            if ($car_id && $marke && $date_reservation && $date_retour) {
                $_SESSION['car_id'] = $car_id;
                $_SESSION['marke'] = $marke;
                $_SESSION['price'] = $price;
                $_SESSION['date_reservation'] = $date_reservation;
                $_SESSION['date_retour'] = $date_retour;
                header("Location: ./views/reservInfo.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid booking data.";
                header("Location: ./error.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid request.";
            header("Location: ./error.php");
            exit();
        }
    }

    /** Saves reservation data to the database.
     * This method handles a POST request to save a car reservation. It retrieves reservation
     * details from the session and POST data, converts the date formats to match the database 
     * requirements, and attempts to insert the reservation into the database using the ReservInfo model.
     * If successful, it redirects the user to the reservation confirmation page. If an error occurs
     * or the data is invalid, it redirects to an error page.
     * @return void */
    public function saveReservationToDatabase() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $car_id = $_SESSION['car_id'] ?? null;

            // Retrieve raw date inputs from the form
            $date_reservation_raw = $_POST['date_reservation'] ?? '';
            $date_retour_raw = $_POST['date_retour'] ?? '';
            $date_reservation = DateTime::createFromFormat('d/m/Y', $date_reservation_raw)?->format('Y-m-d');
            $date_retour = DateTime::createFromFormat('d/m/Y', $date_retour_raw)?->format('Y-m-d');
            $user_id = $_SESSION['user']['id'] ?? null;
            // Check if all required data is available
            if ($car_id && $date_reservation && $date_retour && $user_id) {
                // Create a new instance of the reservation model
                $reservInfo = new ReservInfo();

                // Attempt to insert the reservation into the database
                $success = $reservInfo->insertReservationWithCarId($car_id, $date_reservation, $date_retour, $user_id);
                if ($success) {
                    $_SESSION['success'] = "Reservation saved successfully.";
                    header("Location: ./views/myReservation.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Error saving reservation.";
                    header("Location: ./error.php");
                     exit();
                }
            } else {
                $_SESSION['error'] = "Invalid booking data.";
                header("Location: ./error.php");
                exit();
            }
        } else {
            // If the request is not POST, it's invalid; redirect to the error page
            $_SESSION['error'] = "Invalid request.";
            header("Location: ./error.php");
             exit();
        }
    }
}
?>
