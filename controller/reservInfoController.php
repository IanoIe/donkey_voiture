<?php
require_once("./models/ReservInfo.php");

class ReservInfoController {
    public function reservInfo() {
        session_start();
        
        $carId = isset($_POST['car_id']) && is_numeric($_POST['car_id']) ? (int) $_POST['car_id'] : null;
        
        if (!$carId) {
            die("Id car invalid");
        }

        $reservInfo = new ReservInfo();
    
        $city_name = $_SESSION['fullname'] ?? 'N/A';
        $car_marke = $_SESSION['car_marke'] ?? 'N/A';
        $date_reservation = $_SESSION['date_reservation'] ?? 'N/A';
        $date_retour = $_SESSION['date_retour'] ?? 'N/A';

        // Busca do banco
        $info = $reservInfo->getReservInfoUnik($carId);

         $userId = $_SESSION['user_id'] ?? null; // Certifique-se de ter o id do usuário na sessão
        if ($userId) {
            $user = $reservInfo->getUser($userId);
        } else {
            $user = null;
        }
    // Disponibilizar variáveis para a view
    require("./views/reservInfo.php");
   }
   

    public function reservInfoUser($idUser) {
        echo "Método reservInfoUser chamado com idUser = $idUser<br>"; // Teste de depuração
        $reservInfo = new ReservInfo();
        try {
            $user = $reservInfo->getUser($idUser);
            if ($user) {
                include("./views/reservInfo.php");
            } else {
                echo "User not found"; 
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

}
?>
