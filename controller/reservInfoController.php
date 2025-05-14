<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}
require_once("./models/ReservInfo.php");
class ReservInfoController {

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
                $_SESSION['error'] = "Dados de reserva inválidos.";
                header("Location: ./error.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Requisição inválida.";
            header("Location: ./error.php");
            exit();
        }
    }

    public function reservInfo() {
        $carId = isset($_SESSION['car_id']) && is_numeric($_SESSION['car_id']) ? (int) $_SESSION['car_id'] : null;
        $reservInfo = new ReservInfo();

        $city_name = $_SESSION['fullname'] ?? 'N/A';
        $carsMarke = $_SESSION['marke'] ?? 'N/A';
        $price = $_SESSION['price'] ?? 'N/A';
        $date_reservation = $_SESSION['date_reservation'] ?? 'N/A';
        $date_retour = $_SESSION['date_retour'] ?? 'N/A';

        $info = $reservInfo->getReservInfoUnik($carId, $city_name, $price, $carsMarke, $date_reservation, $date_retour);
        require("./views/reservInfo.php");
    }

    public function reservInfoUser($idUser) {
        try {            
            $reservInfo = new ReservInfo();
            $user = $reservInfo->getUser($idUser);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: ./views/reservInfo.php");
                exit();
            } else {
                $_SESSION['error'] = "Usuário não encontrado.";
                header("Location: ./error.php");
                exit();
            }
        } catch (Exception $ex) {
            $_SESSION['error'] = "Error retrieving user information.".$ex;
            header("Location: ./error.php");
            exit();
        }
    }

    public function handleReservationRequest() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['car_id'], $_POST['marke'], $_POST['price'], $_POST['date_reservation'], $_POST['date_retour'], $_POST['id']) &&
            is_numeric($_POST['car_id']) && is_numeric($_POST['id'])) {
                $saved = $this->saveReservationDetails();
                if ($saved) {
                    $this->reservInfoUser((int) $_POST['id']);
                    header("Location: ./views/reservInfo.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Error saving reservation data.";
                    header("Location: ./error.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Incomplete data for booking.";
                header("Location: ./error.php");
                exit();
            }
        }
    }
}
?>
