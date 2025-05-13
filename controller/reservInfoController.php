<?php
session_start();
$_SESSION['user'] = $user;
header("Location: ./views/reservInfo.php");

require_once("./models/ReservInfo.php");

class ReservInfoController {

    // Novo método para salvar os detalhes da reserva
    public function saveReservationDetails() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Usando filter_input para segurança
            $car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
            $marke = filter_input(INPUT_POST, 'marke', FILTER_SANITIZE_STRING);
            $date_reservation = filter_input(INPUT_POST, 'date_reservation', FILTER_SANITIZE_STRING);
            $date_retour = filter_input(INPUT_POST, 'date_retour', FILTER_SANITIZE_STRING);
            
            // Verificar se os dados são válidos
            if ($car_id && $marke && $date_reservation && $date_retour) {
                // Guardar dados na sessão
                $_SESSION['car_id'] = $car_id;
                $_SESSION['marke'] = $marke;
                $_SESSION['date_reservation'] = $date_reservation;
                $_SESSION['date_retour'] = $date_retour;

                // Redirecionar para a página de confirmação ou renderizar a view
                header("Location: ./views/reservInfo.php"); 
                exit();
            } else {
                // Mensagem de erro amigável
                $_SESSION['error'] = "Dados da reserva estão incompletos ou inválidos. Por favor, tente novamente.";
                header("Location: ./error.php"); // página de erro personalizada
                exit();
            }
        } else {
            // Caso o acesso não seja via POST
            echo "Acesso inválido. Por favor, use o método correto.";
        }
    }

    // Método para exibir as informações da reserva
    public function reservInfo() {
        // Verificar se a variável de sessão existe
        $carId = isset($_SESSION['car_id']) && is_numeric($_SESSION['car_id']) ? (int) $_SESSION['car_id'] : null;

        $reservInfo = new ReservInfo();
        
        // Pegar dados da sessão
        $city_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'N/A';
        $carsMarke = isset($_SESSION['marke']) ? $_SESSION['marke'] : 'N/A';
        $date_reservation = isset($_SESSION['date_reservation']) ? $_SESSION['date_reservation'] : 'N/A';
        $date_retour = isset($_SESSION['date_retour']) ? $_SESSION['date_retour'] : 'N/A';

        // Recuperar informações específicas da reserva
        $info = $reservInfo->getReservInfoUnik($carId, $city_name, $carsMarke, $date_reservation, $date_retour);

        // Renderizar a view de informações da reserva
        require("./views/reservInfo.php");
    }

    // Método para buscar informações do usuário
    public function reservInfoUser($idUser) {
        try {
            $reservInfo = new ReservInfo();
            $user = $reservInfo->getUser($idUser);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: ./views/reservInfo.php?");
                exit();
            } else {
                $_SESSION['error'] = "Usuário não encontrado.";
                header("Location: ./error.php");
                exit();
            }
        } catch (Exception $ex) {
            $_SESSION['error'] = "Erro ao recuperar informações do usuário.";
            header("Location: ./error.php");
            exit();
        }
    }
}
?>
