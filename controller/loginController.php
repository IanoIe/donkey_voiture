<?php
session_start();
require_once("./models/MyLogin.php");

class loginController {
     // Method that verifies if the user is logged in, if not, redirects to the login page
    public function verificarLogin() {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: MyLogin.php");
            exit;
        }
    }

    // Method that handles user login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $pass = $_POST['pass'] ?? '';

            $login = new MyLogin();
            $userId = $login->login($email, $pass);

            if ($userId) {
                $userData = $login->getUserById($userId); // <- Aqui você busca todos os dados

                if ($userData) {
                    $_SESSION['user'] = $userData; // Agora sim você tem os campos completos
                    header("Location: http://localhost:8000/location.php");
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao buscar dados do usuário.";
                }
            } else {
                $_SESSION['error'] = "Email ou senha incorretos.";
            }
        }
        include("./views/myLogin.php");
    }

    /**
     * Method that logs out the user
     */
    public function logout() {
        session_unset();  
        session_destroy(); 
        header("Location: /MyLogin.php");
        exit;
    }
}
?>