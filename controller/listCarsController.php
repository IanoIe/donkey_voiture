<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}

require_once("./models/ListCars.php");
require_once("./models/MyLocation.php");

class listCarsController {
    /**
    * Displays a list of available cars based on user input.
    * This method handles the form submission for selecting a city and reservation dates.
    * It validates the input data, sanitizes the values, and checks the availability of cars
    * in the specified city for the given reservation period. If the input is valid and cars
    * are available, it stores the data in the session and retrieves the list of available cars.
    * If any validation fails or no cars are available, it sets an appropriate message to inform
    * the user.
    * @return void */
    public function showListCars() { 
        $location = new MyLocation();
        $carsModel = new ListCars();
        $cars = [];
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $cityId = isset($_POST['fullname']) ? (int) $_POST['fullname'] : null;
            $date_reservation = $_POST['date_reservation'] ?? '';
            $date_retour = $_POST['date_retour'] ?? '';

            if (empty($cityId) || empty($date_reservation) || empty($date_retour)) {
                $message = "Please fill in all fields.";
            } else {
                $cityId = htmlspecialchars($cityId, ENT_QUOTES, 'UTF-8');
                $date_reservation = htmlspecialchars($date_reservation, ENT_QUOTES, 'UTF-8');
                $date_retour = htmlspecialchars($date_retour, ENT_QUOTES, 'UTF-8');
                // Date validation
                $data_reservation = DateTime::createFromFormat('Y-m-d', $date_reservation);
                $data_retour = DateTime::createFromFormat('Y-m-d', $date_retour);
                if (!$data_reservation || !$data_retour) {
                    $message = "Invalid date format.";
                } elseif ($data_retour <= $data_reservation) {
                    $message = "Return date must be after booking date.";
                } else {
                    // Convert to d/m/Y format
                    $date_reservation = $data_reservation->format('d/m/Y');
                    $date_retour = $data_retour->format('d/m/Y');
                    // Save in session
                    $_SESSION['fullname'] = $location->getCityById($cityId)['fullname'] ?? '';
                    $_SESSION['date_reservation'] = $date_reservation;
                    $_SESSION['date_retour'] = $date_retour;
                    // Search for cars available until the reservation date
                    $cars = $carsModel->getCarsByCityName($cityId, $date_reservation);
                    if (empty($cars)) {
                        $message = "There are no cars available in this city after this date.";
                    }
                }
            }
        }
        // Send the data to the view
        require("./views/myListCars.php");
    }
}
?>
