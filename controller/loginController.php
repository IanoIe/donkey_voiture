<?php
session_start();

$_SESSION['user'] = [
    'id' => $user['id'],
    'lastName' => $user['lastName'],
    'firstName' => $user['firstName'],
    "phone" => $user['phone']
];


require_once("./models/MyLogin.php");
     
class loginController {
    public function verificarLogin() {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: MyLogin.php");
            exit;
        }
    }
     /** method that controls unauthorized access, allowing only logged-in users to access 
     * certain pages, while the login and registration page remains accessible.*/
    public function login() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'] ?? '';
            $pass = $_POST['pass'] ?? '';

            $login = new MyLogin();
            $userId = $login->login($email, $pass);
            
            if ($userId) {
                $_SESSION['id'] = $userId['id'];
                header("Location: http://localhost:8000/location.php");
                exit;
            } else {
                $error = "email ou Passowrd incorrect.";
            }
        }

        include("./views/myLogin.php");
    }
     public function logout() {
        // Finaliza a sessão
        session_unset();
        session_destroy();
        header("Location: MyLogin.php");
        exit;
    }
}
?>